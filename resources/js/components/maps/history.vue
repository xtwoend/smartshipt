<template>
    <div class="row g-0">
        <div class="col-9">
            <div class="position-relative">
                <div class="pointer-info" ref="pointerInfo"></div>
                <MapboxMap
                    @mb-created="(mapboxInstance) => map = mapboxInstance"
                    @mb-load="loaded"
                    @mb-mousemove="pointerLocation"
                    style="height: calc(100vh - 128px); width: 100%;"
                    access-token="pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ"
                    map-style="mapbox://styles/mapbox/outdoors-v12"
                    :center="[105.987732, -5.898973]"
                    :zoom="7"
                    >
                    <MapboxNavigationControl position="bottom-right" />
                </MapboxMap>
            </div>
        </div>
        <div class="col-3">
            <header class="navbar navbar-expand-md navbar-dark bg-primary d-print-none">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 6l16 0"></path>
                                        <path d="M4 12l16 0"></path>
                                        <path d="M4 18l16 0"></path>
                                    </svg>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sailboat" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1"></path>
                                        <path d="M4 18l-1 -3h18l-1 3"></path>
                                        <path d="M11 12h7l-7 -9v9"></path>
                                        <path d="M8 7l-2 5"></path>
                                    </svg>
                                </span>
                                Voyage
                            </a>
                        </li>
                    </ul>
                </div>
            </header>
            <div class="information">

                <div class="histories">
                    <table class="table card-table table-vcenter text-nowrap datatable table-fixed text-small">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Lon</th>
                                <th>Lat</th>
                                <th>Speed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="t in items" :key="t.id" @click="toPotition(t)" class="pointer">
                                <td>{{ $filters.dateformat(t.terminal_time) }}</td>
                                <td>{{ $filters.str_limit(t.lng, 7) }}&deg;</td>
                                <td>{{ $filters.str_limit(t.lat, 6) }}&deg;</td>
                                <td>{{ t.sog  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'mapbox-gl/dist/mapbox-gl.css';
import { MapboxMap, MapboxNavigationControl } from '@studiometa/vue-mapbox-gl';
import mapboxgl from 'mapbox-gl';
import shipIcon from './ship.png';
import coordinates from './widuri.json';

export default {
    components: {
        MapboxMap, 
        MapboxNavigationControl
    },
    data () {
        return {
            map: null,
            current: [],
            items: [],
            potition: false
        }
    },
    methods: {
        async loaded() {
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

            coordinates.forEach((row, i) => {
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
                this.items.push(row)
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

            this.map.loadImage(shipIcon, (err, img) => {
                if(err) throw err
                that.map.addImage('ship-icon', img);
            })

            let latest = this.items[this.items.length - 1];
            this.positionShip({heading: latest.heading, lng: latest.lng, lat: latest.lat})
        },

        toPotition(row) {
            this.positionShip(row)
        },

        positionShip(row) {

            if(this.potition) {
                this.map.removeLayer('ship-point');
                this.map.removeSource('ship-point');
            }

            this.map.addSource('ship-point', {
                "type": "geojson",
                "data": {
                    "type": "FeatureCollection",
                    "features": [
                        {
                            "type": "Feature",
                            "geometry": {
                                "type": "Point",
                                "coordinates": [row.lng, row.lat],
                            },
                            "properties": {
                                "scale": 1,
                                "heading": row.heading,
                            }
                        }
                    ]
                }
            });

            this.map.addLayer({
                "id": 'ship-point',
                "type": "symbol",
                "source": 'ship-point',
                "layout": {
                    "icon-image": 'ship-icon',
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
            this.potition = true;
        },

        pointerLocation (e) {
            let position = e.lngLat.wrap();
            this.$refs.pointerInfo.innerHTML = `<span> ${position.lat.toFixed(5)}</span><span> ${position.lng.toFixed(5)}</span>` 
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
.table-fixed thead {
  width: 100%;
}
.table-fixed tbody {
  height: 230px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}
.nav-link-icon {
    color: #fff;
}
.table-fixed.text-small tbody td {
    font-size: 10px !important;
}
</style>