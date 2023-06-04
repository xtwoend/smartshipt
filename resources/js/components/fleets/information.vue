<template>
    <div v-if="fleet">
        <fleet-speedometer :fleet="fleet"></fleet-speedometer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-title">
                        <h6>Navigation information</h6>
                    </div>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row">•</th>
                                <td>Updated at</td>
                                <td class="text-end">{{ fleet.last_connection }}</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Coordinate</td>
                                <td class="text-end">{{ fleet.navigation.lat.toFixed(5) }} {{ fleet.navigation.lat_dir }},
                                    {{ fleet.navigation.lng.toFixed(5) }} {{ fleet.navigation.lng_dir }}</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Heading</td>
                                <td class="text-end">{{ fleet.navigation.heading }} °</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Course / COG</td>
                                <td class="text-end">{{ fleet.navigation.cog }} °</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Speed / SOG</td>
                                <td class="text-end">{{ fleet.navigation.sog }} knot</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Depth</td>
                                <td class="text-end">{{ fleet.navigation.depth }} meter</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Wind Speed</td>
                                <td class="text-end">{{ fleet.navigation.wind_speed }} knot</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Wind Direction</td>
                                <td class="text-end">{{ fleet.navigation.wind_direction }} °</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Total Travel Distance</td>
                                <td class="text-end">{{ fleet.navigation.distance }} NM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="table-title mb-4 mt-2">
                        <h6>Echo Sounder Trend</h6>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-6">
                            <form class="d-flex align-items-center justify-content-end gap-1">
                                <widget-daterange></widget-daterange>
                                <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        1 H
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">1 H</a></li>
                                            <li><a class="dropdown-item" href="#">1 D</a></li>
                                            <li><a class="dropdown-item" href="#">1 W</a></li>
                                        </ul>
                                    </div>
                                <button type="submit" class="btn btn-primary">SHOW</button>
                            </form>
                        </div>
                    </div>
                    <charts-spline></charts-spline>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FleetSpeedometer from './speedometer.vue'
export default {
    props: {
        url: String,
    },
    components: { FleetSpeedometer },
    data() {
        return {
            fleet: null
        }
    },
    created() {
        this.fetchData()
    },
    mounted() {
        setInterval(() => this.fetchData(), 5 * 1000)
    },
    methods: {
        async fetchData() {
            this.fleet = await axios.get(this.url).then(res => res.data);
        },
    }
}
</script>

<style lang="scss"></style>