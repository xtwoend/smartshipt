<template>
    <div class="position-relative">
        <x-search :fleets="fleets" @selected="findFleet"></x-search>
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
            map-style="mapbox://styles/mapbox/navigation-day-v1"
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
import shipIcon from './ship.png'
// import coordinates from './widuri.json';
import search from './search.vue';
import notification from './notification.vue';
import records from './records.vue';
import navigation from './navigation.vue';
import camera from './camera.vue';
import parameter from './parameter.vue';
import * as timeago from 'timeago.js';

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
            map: null,
            current: [],
            timer: null,
            fleets: [],
            zoom: 3,
            center: [118, 0.0],
            popup: null
        }
    },
    mounted(){
        this.timer = setInterval(() => {
            this.loaded()
        }, (15 * 1000))

        this.map.loadImage(shipIcon, (err, img) => {
            if(err) throw err
            this.map.addImage(`ship`, img);
        })

        this.popup = new mapboxgl.Popup({
            closeButton: true,
            closeOnClick: false
        });
    },
    methods: {
        async loaded() {
            let {data} = await axios.get('/api/fleets')
            this.fleets = data;
            data.forEach((row) => {
                this.positionShip(row)
            })
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

        positionShip(row) {

            // skip if nav null
            if(! row.navigation) return;
            let that = this

            // remove layers
            let mapLayer = this.map.getLayer(`ship-positions-${row.id}`);
            if(typeof mapLayer !== 'undefined') {
                this.map.removeLayer(`ship-positions-${row.id}`).removeSource(`ship-positions-${row.id}`);
            }
            
            this.map.addSource(`ship-positions-${row.id}`, {
                "type": "geojson",
                "data": {
                    "type": "FeatureCollection",
                    "features": [
                        {
                            "type": "Feature",
                            "geometry": {
                                "type": "Point",
                                "coordinates": [row.navigation.lng, row.navigation.lat],
                            },
                            "properties": {
                                "scale": 1,
                                "id": row.id,
                                "heading": row.navigation.heading,
                                "name": row.name,
                                "image": row.image,
                                "sog": row.navigation.sog,
                                "cog": row.navigation.cog,
                                "last_update": timeago.format(row.navigation.updated_at )
                            }
                        }
                    ]
                }
            });

            this.map.addLayer({
                "id": `ship-positions-${row.id}`,
                "type": "symbol",
                "source": `ship-positions-${row.id}`,
                "layout": {
                    "icon-image": `ship`,
                    "icon-allow-overlap": true,
                    "icon-ignore-placement": true,
                    "icon-size": 0.3,
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

            this.map.on('click', `ship-positions-${row.id}`, (e) => {
                // open side information
                let fleetId = e.features[0].properties.id;
                location.href = `/fleet/${fleetId}`;
            })
            
            this.map.on('mouseenter', `ship-positions-${row.id}`, (e) => {
                that.map.getCanvas().style.cursor = 'pointer';
                const coordinates = e.features[0].geometry.coordinates.slice();
                const text = `<b>${e.features[0].properties.name} [ID]</b> at ${e.features[0].properties.sog} <b>kn</b> / ${e.features[0].properties.cog}&deg;<br>last update: <b>${e.features[0].properties.last_update}</b>`;
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                popup.setLngLat(coordinates).setHTML(text).addTo(that.map);
            });
            
            this.map.on('mouseleave', `ship-positions-${row.id}`, () => {
                that.map.getCanvas().style.cursor = '';
                popup.remove();
            });
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