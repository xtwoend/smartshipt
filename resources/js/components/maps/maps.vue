<template>
    <div class="position-relative overflow-hidden">
        <map-voyage 
            :fleet="fleet" 
            @history="setHistory" 
            @selected="toPotition"
            :display="sidebar"
        ></map-voyage>
        <x-weathers class="maps" @selected="weatherSelected" bottom="10px"></x-weathers>
        <div class="pointer-info" ref="pointerInfo"></div>
        <!-- <div class="lengend">
            <div class="title">Fleet Color Information</div>
            <div><img src="../icon/green.png"> Underway </div>
            <div><img src="../icon/red.png"> Other </div>
            <div><img src="../icon/blue.png"> At Port </div>
            <div><img src="../icon/yellow.png"> At Anchorage</div>
        </div> -->
        <MapboxMap
            id="map"
            @mb-created="mbCreated"
            @mb-load="loaded"
            @mb-mousemove="pointerLocation"
            :style="style"
            access-token="pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ"
            map-style="mapbox://styles/mapbox/outdoors-v11"
            :center="[fleet.navigation.lng, fleet.navigation.lat]"
            :zoom="7"
            >
            <MapboxNavigationControl position="bottom-right" />
        </MapboxMap>
    </div>
</template>

<script>
import 'mapbox-gl/dist/mapbox-gl.css';
import { MapboxMap, MapboxNavigationControl } from '@studiometa/vue-mapbox-gl';
import mapboxgl from 'mapbox-gl';
window.mapboxgl = mapboxgl;

import shipIcon from './ship.png';
import * as timeago from 'timeago.js';
import weatherLayers from './weather_layers.vue';

import { isProxy, toRaw } from 'vue';

export default {
    components: {
        MapboxMap, 
        MapboxNavigationControl,
        'x-weathers': weatherLayers,
    },
    props: {
        fleet: Object,
        style: Object,
        sidebar: Boolean
    },
    data() {
        return {
            map: null,
            current: [],
            timer: null,
            popup: new mapboxgl.Popup({
                closeButton: true,
                closeOnClick: false
            }),
            histories: []
        }
    },
    mounted(){
        this.map.loadImage(shipIcon, (err, img) => {
            if(err) throw err
            this.map.addImage(`ship-icon`, img);
        })
    },
    methods: {
        weatherSelected(e) {
            this.weatherLayers = e
            this.buildWeatherLayers()
        },
        mbCreated(map) {
            this.addWeatherController(map)
            this.map = map
        },
        addWeatherController(map)
        {
            const realMap = isProxy(map) ? toRaw(map) : map;
            const account = new mapsgl.Account('1OptPL41nvsQuBRwEGjxm', '3Zgw6M8pyzNF6daJUolYQ7ZMbfW4eFrzJ0LM7P2t');
            const controller = new mapsgl.MapboxMapController(realMap, {
                account: account,
                animation: {
                    duration: 2,
                    endDelay: 1,
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
            let lastIndex = this.weatherLayers[this.weatherLayers.length - 1];
            this.weatherLayers.forEach(code => {
                if(! controller.hasWeatherLayer(code)) {
                    controller.addWeatherLayer(code)
                }
            })
            // move to top layer
            this.map.moveLayer('ship-position', this.weatherLayers[lastIndex]);
            // add legend
            controller.addLegendControl('#map', { 
                width: 360,
            });
            // add inspector
            controller.addDataInspectorControl();    
        },
        setHistory(e){
            this.histories = e
            let that = this

            if(this.current.length > 0 && this.map.getLayer('route') !== 'undefined' && this.map.getLayer('points') !== 'undefined') {
                this.map.removeLayer('route');
                this.map.removeSource('route');
                this.map.removeLayer('points');
                this.map.removeSource('points');
            }

            let routes = {
                type: 'Feature',
                properties: {},
                geometry: {
                    type: 'LineString',
                    coordinates: []
                }
            }

            let points = {
                type: 'FeatureCollection',
                features: []
            }

            this.histories.forEach((row, i) => {
                //routes
                routes.geometry.coordinates.push([row.lng, row.lat])
                //points
                points.features.push({
                    type: 'Feature',
                    properties: {
                        cog: row.cog,
                        sog: row.sog,
                        time: this.$filters.dateformat(row.terminal_time, 'DD/MM/YYYY HH:mm'),
                        lat: row.lat,
                        lng: row.lng,
                        heading: row.heading
                    },
                    geometry: {
                        type: 'Point',
                        coordinates: [row.lng, row.lat]
                    }
                })
                this.current = [row.lng, row.lat]
            })
            
            this.map.addSource('route', {
                type: 'geojson',
                data: routes
            })

            this.map.addLayer({
                'id': 'route',
                'type': 'line',
                'source': 'route',
                'layout': {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                'paint': {
                    'line-color': '#3B4EF5',
                    'line-width': 1.5,
                    'line-dasharray': [3, 3],
                }
            });
             
            // point
            this.map.addSource('points', {
                "type": "geojson",
                "data": points
            })
            
            this.map.addLayer({
                'id': 'points',
                'type': 'circle',
                'source': 'points',
                'paint': {
                    'circle-radius': 4,
                    'circle-color': '#3B4EF5'
                }
            });

            const popup = new mapboxgl.Popup({
                closeButton: false,
                closeOnClick: false
            });

            this.map.on('click', 'points', (e) => {
                // open side information
                let data = e.features[0].properties;
                this.positionShip(data)
            })
            
            // Create a popup, but don't add it to the map yet.      
            this.map.on('mouseenter', 'points', (e) => {
                that.map.getCanvas().style.cursor = 'pointer';
                const coordinates = e.features[0].geometry.coordinates.slice();
                const text = `<b>Lat : ${e.features[0].properties.lat} | Lng: ${e.features[0].properties.lng}</b> at ${e.features[0].properties.sog} <b>kn</b> / ${e.features[0].properties.cog}&deg;<br>Time: <b>${e.features[0].properties.time}</b>`;
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                popup.setLngLat(coordinates).setHTML(text).addTo(that.map);
            })

            this.map.on('mouseleave', 'points', () => {
                that.map.getCanvas().style.cursor = '';
                popup.remove();
            });

            let latest = this.histories[this.histories.length - 1];
            let nav = Object.assign({}, {
                id: this.fleet.id,
                name: this.fleet.name,
                image: this.fleet.image,
                navigation: latest
            })
            // console.log(nav)
            this.positionShip(nav)
            // this.positionShip({heading: latest.heading, lng: latest.lng, lat: latest.lat})
        },
        pointerLocation (e) {
            let position = e.lngLat.wrap();
            this.$refs.pointerInfo.innerHTML = `<span> ${position.lat.toFixed(5)}</span><span> ${position.lng.toFixed(5)}</span>` 
        },
        loaded () {
            this.positionShip(this.fleet)
            this.loadWeather()
        },
        loadWeather() {
            console.log('asdafdf');
            const account = new aerisweather.mapsgl.Account('1OptPL41nvsQuBRwEGjxm', '3Zgw6M8pyzNF6daJUolYQ7ZMbfW4eFrzJ0LM7P2t');
            const controller = new aerisweather.mapsgl.MapboxMapController(this.map, { account });
            controller.on('load', () => {
                // Do stuff, like add weather layers
                controller.addWeatherLayer('radar');
                controller.addWeatherLayer('alerts-outline', {
                    paint: {
                        opacity: 0.5
                    }
                });
            });
        },
        toPotition(row) {
            let nav = Object.assign({}, {
                id: this.fleet.id,
                name: this.fleet.name,
                image: this.fleet.image,
                navigation: row
            })
            // console.log(nav)
            this.positionShip(nav)
        },
        positionShip(row) {
            if(! row.navigation) return;
            // remove layers
            let mapLayer = this.map.getLayer(`ship-position`);
            if(typeof mapLayer !== 'undefined') {
                this.map.removeLayer(`ship-position`).removeSource(`ship-points`);
            }

            this.map.addSource(`ship-points`, {
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
                                "last_update": timeago.format(row.navigation.terminal_time),
                                "time": this.$filters.dateformat(row.navigation.terminal_time, 'DD/MM/YYYY HH:mm')
                            }
                        }
                    ]
                }
            });

            this.map.addLayer({
                "id": `ship-position`,
                "type": "symbol",
                "source": `ship-points`,
                "layout": {
                    "icon-image": `ship-icon`,
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
            this.popup.remove();
            const text = `<b>${row.name} [ID]</b> at ${row.navigation.sog} <b>kn</b> / ${row.navigation.cog}&deg;<br>Last update: <b>${timeago.format(row.navigation.updated_at)}</b><br>Time: <b>${this.$filters.dateformat(row.navigation.updated_at, 'DD/MM/YYYY HH:mm')}</b>`;
            this.popup.setLngLat([row.navigation.lng, row.navigation.lat]).setHTML(text).addTo(this.map);
        },
    }
}
</script>

<style lang="scss">
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

.maps.weathers {
    width: 300px;
    top: 10px;
    left: 10px;
}
</style>