<template>
    <div class="position-relative">
        <x-search :fleets="fleets" @selected="findFleet"></x-search>
        <fleet-side-info 
            v-if="fleet"
            :fleet="fleet"
            :display="showSideInfo"
            @close="showSideInfo=false"
            @history="buildTrack"
        ></fleet-side-info>
        <!-- <x-records></x-records> -->
        <!-- <x-navigation></x-navigation> -->
        <!-- <x-camera></x-camera> -->
        <!-- <x-notification></x-notification> -->
        <!-- <x-parameter></x-parameter> -->
        <div class="pointer-info" ref="pointerInfo"></div>
        <MapboxMap
            @mb-created="(mapboxInstance) => map = mapboxInstance"
            @mb-load="loaded"
            @mb-mousemove="pointerLocation"
            style="height: calc(100vh - 128px); width: 100%;"
            access-token="pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ"
            map-style="mapbox://styles/mapbox/outdoors-v11"
            :center="center"
            :zoom="zoom"
            >
            <MapboxNavigationControl position="bottom-right" />
        </MapboxMap>
    </div>
</template>

<script>
import 'mapbox-gl/dist/mapbox-gl.css';
import { MapboxMap, MapboxNavigationControl } from '@studiometa/vue-mapbox-gl';
import mapboxgl from 'mapbox-gl';
window.mapboxgl = mapboxgl

import search from './search.vue';
import notification from './notification.vue';
import records from './records.vue';
import navigation from './navigation.vue';
import camera from './camera.vue';
import parameter from './parameter.vue';
import * as timeago from 'timeago.js';
import blueShip from '../icon/blue.png';
import greenShip from '../icon/green.png';
import redShip from '../icon/red.png';

import  * as interpolate from 'interpolateheatmaplayer';

export default {
    components: {
        'x-search': search,
        'x-notification': notification,
        'x-records': records,
        'x-navigation': navigation,
        'x-camera': camera,
        'x-parameter': parameter,
        MapboxMap, 
        MapboxNavigationControl
    },
    data() {
        return {
            weatherKey: 'dfc256782db426c6a8d3b8daaefa5b33',
            icons: {
                ballast: blueShip,
                laden: greenShip,
                at_port: redShip,
            },
            map: null,
            current: [],
            timer: null,
            fleets: [],
            zoom: 3,
            center: [118, 0.0],
            popup: null,
            fleet: null,
            showSideInfo: false,
            fleets_point: {
                type: 'FeatureCollection',
                features: []
            }
        }
    },
    mounted(){
        this.timer = setInterval(() => {
            this.refreshData()
        }, (5 * 1000))

        this.map.loadImage(this.icons['ballast'], (err, img) => {
            if(err) throw err
            this.map.addImage('ship-blue', img);
        })

        this.map.loadImage(this.icons['at_port'], (err, img) => {
            if(err) throw err
            this.map.addImage('ship-red', img);
        })

        this.map.loadImage(this.icons['laden'], (err, img) => {
            if(err) throw err
            this.map.addImage('ship-green', img);
        })

        this.popup = new mapboxgl.Popup({
            closeButton: true,
            closeOnClick: false
        });
    },
    methods: {
        async fetchData() {
            let {data} = await axios.get('/api/fleets')
            this.fleets = data;
            this.fleets_point.features = [];
            data.forEach((row) => {
                if(row.navigation){
                    let icon = 'ship-blue';
                    if(row.fleet_status == 'at_port') {
                        icon = 'ship-red';
                    }else if(row.fleet_status == 'laden') {
                        icon = 'ship-green';
                    }
                    this.fleets_point.features.push({
                        type: "Feature",
                        geometry: {
                            type: "Point",
                            coordinates: [row.navigation.lng, row.navigation.lat],
                        },
                        properties: {
                            scale: 1,
                            id: row.id,
                            heading: row.navigation.heading,
                            name: row.name,
                            image: row.image,
                            status: row.fleet_status,
                            icon: icon,
                            sog: row.navigation.sog,
                            cog: row.navigation.cog,
                            last_update: timeago.format(row.last_connection)
                        }
                    })
                }
            })
        },
        async loaded() {
            await this.fetchData()
            // await this.buildWeathers()
            this.buildLayer()
        },

        async refreshData() {
            await this.fetchData()
            let data = this.map.getSource('ship-position');
            if(data) {
                data.setData(this.fleets_point)
            }
        },

        buildLayer() {
            let that = this;
            // point
            this.map.addSource('ship-position', {
                type: 'geojson',
                data: this.fleets_point
            })
            
            this.map.addLayer({
                id: 'ship-position',
                type: 'symbol',
                source: 'ship-position',
                layout: {
                    "icon-image": ['get', 'icon'],
                    "icon-allow-overlap": true,
                    "icon-ignore-placement": true,
                    "icon-size": 0.12,
                    "icon-rotate": {
                        property: "heading",
                        stops: [
                            [-360, -360],
                            [0, 0],
                            [360,360]
                        ]
                    },
                    "icon-rotation-alignment": "map"
                }
            });

            // Create a popup, but don't add it to the map yet.
            const popup = new mapboxgl.Popup({
                closeButton: false,
                closeOnClick: false
            });

            this.map.on('click', 'ship-position', (e) => {
                // open side information
                let fleetId = e.features[0].properties.id;
                that.showInfo(fleetId)
            })
            
            this.map.on('mouseenter', 'ship-position', (e) => {
                that.map.getCanvas().style.cursor = 'pointer';
                const coordinates = e.features[0].geometry.coordinates.slice();
                const text = `<b>${e.features[0].properties.name} [ID]</b> at ${e.features[0].properties.sog} <b>kn</b> / ${e.features[0].properties.cog}&deg;<br>last update: <b>${e.features[0].properties.last_update}</b>`;
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                popup.setLngLat(coordinates).setHTML(text).addTo(that.map);
            });
            
            this.map.on('mouseleave', 'ship-position', () => {
                that.map.getCanvas().style.cursor = '';
                popup.remove();
            });
        },

        async buildWeathers() {
            const startingLatitude = -40;
            const startingLongitude = -140;
            const endingLatitude = 40;
            const endingLongitude = 140;
            const n = 10;
            const points = [];
            for (let i=0; i < n; i++) {
                for (let j=0; j < n; j++) {
                    points.push({
                        lat: startingLatitude + i * (endingLatitude - startingLatitude)/n,
                        lng: startingLongitude + j * (endingLongitude - startingLongitude)/n,
                        val: 0
                    })
                }
            }
            // Create the URLs
            const baseUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&lat=";
            const urls = points.map(point => baseUrl + point.lat + "&lon=" + point.lng + "&appid=" + this.weatherKey);
            // Fetch the weather data
            const weathers = await Promise.all(urls.map(async url => {
                const response = await fetch(url);
                return response.text();
            }));
            // Set the temperature
            points.forEach((point, index) => {
                point.val = JSON.parse(weathers[index]).main.temp;
            })

            let layer = interpolate.create({
                points: points,
                layerId: 'temp',
                opacity: 0.2
            });
            
            this.map.addLayer(layer);
        },
        
        findFleet(row) {
            if(! row.navigation) return;
            let fleetId = row.id
            this.popup.remove();
            const text = `<a class="no-style" href="/fleet/${fleetId}"><b>${row.name} [ID]</b> at ${row.navigation.sog} <b>kn</b> / ${row.navigation.cog}&deg;<br>last update: <b>${timeago.format(row.navigation.updated_at )}</b></a>`;
            this.popup.setLngLat([row.navigation.lng, row.navigation.lat]).setHTML(text).addTo(this.map);
            this.center = [row.navigation.lng, row.navigation.lat]
            this.zoom = 5
        },

        pointerLocation (e) {
            let position = e.lngLat.wrap();
            this.$refs.pointerInfo.innerHTML = `<span> ${position.lat.toFixed(5)}</span><span> ${position.lng.toFixed(5)}</span>` 
        },

        showInfo(fleetId) {
            let fIndex = this.fleets.findIndex(function(row) {
                return row.id === fleetId;
            });
            if(fIndex >= 0) {
                this.fleet = this.fleets[fIndex];
                this.showSideInfo = true
            }
        },
        buildTrack(e) {
            console.log(e)
        }   
    }
}
</script>

<style lang="scss">
.main-body{
    position: absolute;
    width: 100%;
    height: 100%;
    padding-top: 8em;
    padding-left: 2em;
    padding-right: 2em;
    padding-bottom: 2em;
    z-index: 3;
}
.pointer-info {
    position: absolute;
    right: 60px;
    bottom: 35px;
    width: 120px;
    background: transparent;
    color: #fff;
    z-index: 2;
    span {
        display: block;
        text-align: right;
        text-shadow: 0 0 4px #000;
    }
}

a.no-style {
    color: #000;
}
</style>