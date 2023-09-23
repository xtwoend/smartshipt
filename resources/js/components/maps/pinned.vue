<template>
    <div class="col-12">
        <div class="mapbox-pinned">
            <MapboxMap @mb-created="(mapboxInstance) => map = mapboxInstance" @mb-load="loaded"
                :style="style"
                access-token="pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ"
                map-style="mapbox://styles/mapbox/outdoors-v11" :center="[location.lng, location.lat]"
                :zoom="7">
                <MapboxNavigationControl position="bottom-right" />
            </MapboxMap>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Latitude</label>
            <input name="lat" type="text" v-model="location.lat" class="form-control">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Longitude</label>
            <input name="lng" type="text" v-model="location.lng" class="form-control">
        </div>
    </div>
</template>

<script>
import 'mapbox-gl/dist/mapbox-gl.css';
import { MapboxMap, MapboxNavigationControl } from '@studiometa/vue-mapbox-gl';
import mapboxgl from 'mapbox-gl';
export default {
    components: {
        MapboxMap, 
        MapboxNavigationControl
    },
    props: {
        lat: String,
        lng: String,
        style: Object,
    },
    data() {
        return {
            map: null,
            location: {
                lat: 0,
                lng: 0
            },
            marker: null
        }
    },
    methods: {
        loaded () {
            this.location = {
                lat: this.lat,
                lng: this.lng
            }
            this.marker = new mapboxgl.Marker();
            this.marker.setLngLat(this.location).addTo(this.map);
            this.map.on('click', this.addMarker.bind(this));
        },
        addMarker(e) {
            this.location = e.lngLat;
            this.marker.setLngLat(this.location).addTo(this.map);
        }
    }

}
</script>

<style lang="scss" scoped></style>