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

                <div class="col-12">
                    <div class="table-title mb-4 mt-2">
                        <h6>Trend View</h6>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-6">
                            <dropdown-select :options="columns" @checked="(e) => trendParams.columns = e"></dropdown-select>
                        </div>
                        <div class="col-6">
                            <form class="d-flex align-items-center justify-content-end gap-1">
                                <date-range @selected="(e) => trendParams.date = e "></date-range>
                                <select class="form-control w-5 bordered" v-model="trendParams.interval">
                                    <option value="30">30m</option>
                                    <option value="60">1 H</option>
                                    <option value="1440">1 D</option>
                                </select>
                                <button @click="showChart" class="btn btn-primary">SHOW</button>
                            </form>
                        </div>
                    </div>
                    <trend-nav :params="trendParams" ref="trendNav"></trend-nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FleetSpeedometer from './speedometer.vue'
import DateRange from '../widgets/daterange.vue'
import DropdownSelect from '../widgets/dropdown.vue'
import TrendNav from './trend-nav.vue'
export default {
    props: {
        url: String,
    },
    components: { FleetSpeedometer, DateRange, TrendNav, DropdownSelect },
    data() {
        return {
            fleet: null,
            trendParams: {
                interval: 60,
                date: null
            },
            columns:[
                {data: 'sog', text: 'Speed (knot)'},
                {data: 'wind_speed', text: 'Wind Speed (knot)'},
                {data: 'depth', text: 'Deep (m)'},
            ]
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
        showChart() {
            let params = this.trendParams
            if(! params.date) {
                alert('please selected date first')
            }

            // call api for charts data
            this.$refs.trendNav.show();
        }
    }
}
</script>

<style lang="scss">
.bordered {
    border: 1px solid #616876 !important;
}
</style>
