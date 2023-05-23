<template>
    <div class="position-relative p-3 overflow-hidden">
        <map-voyage @selected="tracks"></map-voyage>
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
            })
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
        pointerLocation (e) {
            let position = e.lngLat.wrap();
            this.$refs.pointerInfo.innerHTML = `<span> ${position.lat.toFixed(5)}</span><span> ${position.lng.toFixed(5)}</span>` 
        },
        loaded () {
            this.positionShip(this.fleet)
        },
        positionShip(row) {
            if(! row.navigation) return;
            this.map.addSource(`ship-points-${row.id}`, {
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
                                "last_update": timeago.format(row.navigation.updated_at + '+7')
                            }
                        }
                    ]
                }
            });

            this.map.addLayer({
                "id": `ship-positions-${row.id}`,
                "type": "symbol",
                "source": `ship-points-${row.id}`,
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