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
        <x-legend :fleets="fleets" @filters="doFilter"></x-legend>
        <x-weathers @selected="weatherSelected"></x-weathers>
        <MapboxMap
            @mb-created="mbCreated"
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
    <fleet-table :fleets="fleets"></fleet-table>
</template>

<script>
import 'mapbox-gl/dist/mapbox-gl.css';
import { MapboxMap, MapboxNavigationControl } from '@studiometa/vue-mapbox-gl';
import mapboxgl from 'mapbox-gl';
window.mapboxgl = mapboxgl;

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
import yellowShip from '../icon/yellow.png';
import purpleShip from '../icon/purple.png';
import fleetLegend from './lagend.vue';
import fleetTable from './fleet_table.vue';
import weatherLayers from './weather_layers.vue';

import { isProxy, toRaw } from 'vue';
            
export default {
    components: {
        'x-search': search,
        'x-notification': notification,
        'x-records': records,
        'x-navigation': navigation,
        'x-camera': camera,
        'x-parameter': parameter,
        'x-legend': fleetLegend,
        'x-weathers': weatherLayers,
        MapboxMap, 
        MapboxNavigationControl,
        fleetTable
    },
    data() {
        return {
            weatherKey: 'dfc256782db426c6a8d3b8daaefa5b33',
            weathers: [],
            icons: {
                at_port: blueShip,
                underway: greenShip,
                lost_connection: redShip,
                at_anchorage: yellowShip,
                other : purpleShip
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
            },
            fleetsGroup: [],
            filters: {},
            weatherController: null,
            weatherLayers: [],
        }   
    },
    async created() {
        await this.fetchData()
    },
    mounted(){
        this.timer = setInterval(() => {
            this.refreshData()
        }, (5 * 1000))

        let that = this
        Object.keys(this.icons).forEach(function(key) {
            that.map.loadImage(that.icons[key], (err, img) => {
                if(err) throw err
                that.map.addImage(key, img);
            })
        });

        this.popup = new mapboxgl.Popup({
            closeButton: true,
            closeOnClick: false
        });
    },
    methods: {
        async fetchData() {
            let {data} = await axios.get('/api/fleets', { params: this.filters })
            
            this.fleets = data;
            this.fleets_point.features = [];
            data.forEach((row) => {
                if(row.navigation){
                    let icon = row.fleet_status;
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
                            depth: row.navigation.depth,
                            sog: row.navigation.sog,
                            cog: row.navigation.cog,
                            imo: row.imo_number,
                            last_update: timeago.format(row.last_connection),
                            time: this.$filters.dateformat(row.last_connection, 'DD/MM/YYYY HH:mm'),
                        }
                    })
                }
            })
        },
        loaded() {
            this.buildLayer()
        },
        mbCreated(map) {
            this.addWeatherController(map)
            this.map = map
        },
        async refreshData() {
            await this.fetchData()
            let data = await this.map.getSource('ship-position');
            if(data) {
                data.setData(this.fleets_point)
            }
        },
        addWeatherController(map)
        {
            const realMap = isProxy(map) ? toRaw(map) : map;
            const account = new mapsgl.Account('wEQlTfMuZVuZGadk0GElq', 'dOlGZOeangNxL5ppi8RczOUZcIUXYqWoCVR0WLsw');
            const controller = new mapsgl.MapboxMapController(realMap, {
                account: account,
                animation: {
                    repeat: true
                },
                units: {
                    temperature: 'C',
                    speed: 'km/h',
                    pressure: 'hPa',
                    distance: 'mi',
                    height: 'm',
                    precipitation: 'm',
                    snowfall: 'm',
                    direction: '°',
                    time: 'hr',
                    ratio: '%'
                }
            })
            controller.on('load', () => this.weatherController = controller);
        },
        buildWeatherLayers(){ 
            const controller = isProxy(this.weatherController) ? toRaw(this.weatherController) : this.weatherController;
            controller.weatherLayerIds.forEach(code => controller.removeWeatherLayer(code));
            this.weatherLayers.forEach(code => {
                if(! controller.hasWeatherLayer(code)) {
                    controller.addWeatherLayer(code)
                }
            })
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
                slot: 'top',
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
                const text = `<b>${e.features[0].properties.name} [ID]</b> at ${e.features[0].properties.sog} <b>kn</b> / ${e.features[0].properties.cog}&deg;<br>Last Update: <b>${e.features[0].properties.last_update}</b><br>Time: <b>${e.features[0].properties.time}</b>`;
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
        findFleet(row) {
            if(! row.navigation) return;
            let fleetId = row.id
            this.popup.remove();
            const text = `<a class="no-style" href="/fleet/${fleetId}"><b>${row.name} [ID]</b> at ${row.navigation.sog} <b>kn</b> / ${row.navigation.cog}&deg;<br>Last Update: <b>${timeago.format(row.last_connection )}</b><br>Time: ${this.$filters.dateformat(row.last_connection, 'DD/MM/YYYY HH:mm')}</a>`;
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
        },
        doFilter(e) {
            this.filters.fleet_status = e.label;
            this.refreshData()
        },
        weatherSelected(e) {
            this.weatherLayers = e
            this.buildWeatherLayers()
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