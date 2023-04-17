<template>
    <div class="position-relative">
        <!-- <x-search></x-search> -->
        <x-notification></x-notification>
        <div class="pointer-info" ref="pointerInfo"></div>
        <MapboxMap
            @mb-created="(mapboxInstance) => map = mapboxInstance"
            @mb-load="loaded"
            @mb-mousemove="pointerLocation"
            style="height: calc(100vh - 56px); width: 100%;"
            access-token="pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ"
            map-style="mapbox://styles/mapbox/navigation-day-v1"
            :center="[105.987732, -5.898973]"
            :zoom="5"
            >
            <MapboxNavigationControl position="bottom-right" />
        </MapboxMap>
    </div>
</template>

<script>
import 'mapbox-gl/dist/mapbox-gl.css';
import { MapboxMap, MapboxNavigationControl } from '@studiometa/vue-mapbox-gl';
import shipIcon from './ship.png'
import coordinates from './widuri.json';
import search from './search.vue';
import notification from './notification.vue';

export default {
    components: {
        'x-search': search,
        'x-notification': notification,
        MapboxMap, 
        MapboxNavigationControl
    },
    data() {
        return {
            map: null,
            current: [],
        }
    },
    methods: {
        async loaded() {
            // let routes = {
            //     type: 'Feature',
            //     properties: {},
            //     geometry: {
            //         type: 'LineString',
            //         coordinates: []
            //     }
            // }

            // coordinates.forEach((row, i) => {
            //     if(this.current){
            //         let r = this.calcCrow(this.current[1], this.current[0], row.lat, row.lng);
            //         if(r > 200) {
            //             return;
            //         }
            //     }
            //     routes.geometry.coordinates.push([row.lng, row.lat])
            //     this.current = [row.lng, row.lat]
            // })

            // this.map.addSource('route', {
            //     type: 'geojson',
            //     data: routes
            // })

            // this.map.addLayer({
            //     'id': 'route',
            //     'type': 'line',
            //     'source': 'route',
            //     'layout': {
            //         'line-join': 'round',
            //         'line-cap': 'round'
            //     },
            //     'paint': {
            //         'line-color': '#40f793',
            //         'line-width': 2
            //     }
            // });
            // let lastPosition = coordinates[coordinates.length - 1]
            // console.log(lastPosition)

            let {data} = await axios.get('/api/vessel/navi')
            data.forEach((row) => {
                this.positionShip(row)
            })
        },

        pointerLocation (e) {
            let position = e.lngLat.wrap();
            this.$refs.pointerInfo.innerHTML = `<span> ${position.lat.toFixed(5)}</span><span> ${position.lng.toFixed(5)}</span>` 
        },

        positionShip(row) {
            // skip if nav null
            if(! row.navigation) return;

            let that = this
            
            this.map.loadImage(shipIcon, (err, img) => {
                if(err) throw err
                this.map.addImage(`ship-${row.id}`, img);
            })

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
                                "heading": row.navigation.heading,
                                "name": row.name,
                                "image": row.image
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
                    "icon-image": `ship-${row.id}`,
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

            this.map.on('click', `ship-positions-${row.id}`, (e) => {
                const coordinates = e.features[0].geometry.coordinates.slice();
                const name = e.features[0].properties.name;
                console.log(coordinates, name)
                alert(name)
            })
            // Change the cursor to a pointer when the mouse is over the places layer.
            this.map.on('mouseenter', `ship-positions-${row.id}`, () => {
                that.map.getCanvas().style.cursor = 'pointer';
            });
            
            // Change it back to a pointer when it leaves.
            this.map.on('mouseleave', `ship-positions-${row.id}`, () => {
                that.map.getCanvas().style.cursor = '';
            });
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