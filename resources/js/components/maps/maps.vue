<template>
    <div class="position-relative p-3 overflow-hidden">
        <map-voyage 
            :fleet="fleet" 
            @history="setHistory" 
            @selected="toPotition"
        ></map-voyage>
        <div class="pointer-info" ref="pointerInfo"></div>
        <MapboxMap
            @mb-created="(mapboxInstance) => map = mapboxInstance"
            @mb-load="loaded"
            @mb-mousemove="pointerLocation"
            style="height: 400px; width: 100%;"
            access-token="pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ"
            map-style="mapbox://styles/mapbox/navigation-day-v1"
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
import shipIcon from './ship.png';
import * as timeago from 'timeago.js';

export default {
    components: {
        MapboxMap, 
        MapboxNavigationControl
    },
    props: {
        fleet: Object
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
        tracks(e){
            console.log(e)
        },
        setHistory(e){
            this.histories = e
            let that = this

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
                if(this.current){
                    let r = this.calcCrow(this.current[1], this.current[0], row.lat, row.lng);
                    if(r > 20) {
                        return;
                    }
                }
                //routes
                routes.geometry.coordinates.push([row.lng, row.lat])
                //points
                points.features.push({
                    type: 'Feature',
                    properties: {
                        cog: row.cog,
                        sog: row.sog,
                        time: row.terminal_time,
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
            that.map.addSource('points', {
                "type": "geojson",
                "data": points
            })
            
            that.map.addLayer({
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
                const text = `<b>Lat : ${e.features[0].properties.lat} | Lng: ${e.features[0].properties.lng}</b> at ${e.features[0].properties.sog} <b>kn</b> / ${e.features[0].properties.cog}&deg;<br>time: <b>${e.features[0].properties.time}</b>`;
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
                                "last_update": timeago.format(row.navigation.terminal_time + '+7')
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
            const text = `<b>${row.name} [ID]</b> at ${row.navigation.sog} <b>kn</b> / ${row.navigation.cog}&deg;<br>last update: <b>${timeago.format(row.navigation.updated_at + '+7')}</b>`;
            this.popup.setLngLat([row.navigation.lng, row.navigation.lat]).setHTML(text).addTo(this.map);
        },
        calcCrow(lat1, lon1, lat2, lon2) {
            var R = 6371; // km
            var dLat = this.toRad(lat2-lat1);
            var dLon = this.toRad(lon2-lon1);
            var lat1 = this.toRad(lat1);
            var lat2 = this.toRad(lat2);

            var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            var d = R * c;
            
            return d;
        },
        toRad(Value) {
            return Value * Math.PI / 180;
        }
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
</style>