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
                                <td>Travel Distance</td>
                                <td class="text-end">{{ fleet.navigation.distance }} NM</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Total Travel Distance</td>
                                <td class="text-end">{{ fleet.navigation.total_distance }} NM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FleetSpeedometer from './speedometer.vue'
export default {
    components: { FleetSpeedometer},
    props: {
        url: String
    },
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
        }
    }
}
</script>

<style lang="scss">
.bordered {
    border: 1px solid #616876 !important;
}
</style>
