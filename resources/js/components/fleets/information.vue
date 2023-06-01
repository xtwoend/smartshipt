<template>
    <div v-if="fleet">
        <fleet-speedometer :fleet="fleet"></fleet-speedometer>
        <div class="container">
            <div class="row">
                <div class="col-6">
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
                <div class="col-6">
                    <div class="col-12">
                        <div class="table-title">
                            <h6>Engine Information</h6>
                        </div>
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>RPM Propeller</td>
                                    <td class="text-end">{{ fleet.engine.main_engine_speed }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>Turbo Charger 1</td>
                                    <td class="text-end">{{ fleet.engine.turbo_charger_speed_no_1 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>Turbo Charger 2</td>
                                    <td class="text-end">{{ fleet.engine.turbo_charger_speed_no_2 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>Turbo Charger 3</td>
                                    <td class="text-end">{{ fleet.engine.turbo_charger_speed_no_3 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>Fuel Visco</td>
                                    <td class="text-end">{{ fleet.engine.me_fo_inlet_engine }} cst</td>
                                </tr>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>JFW Inlet Pressure</td>
                                    <td class="text-end">{{ fleet.engine.jcw_inlet }} kg/cm²</td>
                                </tr>
                                <tr>
                                    <th scope="row">•</th>
                                    <td>Lo Inlet Pressure</td>
                                    <td class="text-end">{{ fleet.engine.me_lo_inlet }} kg/cm²</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <!-- Bunker level Information -->
                    <div class="col-12">
                        <div class="table-title">
                            <h6>Bunker level Information</h6>
                        </div>
                        <charts-fuel></charts-fuel>
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="col">Service Name</th>
                                    <th scope="col" colspan="8" class="text-end">Level Capacity (%)</th>
                                    <th scope="col" class="text-end">Value (KL)</th>
                                </tr>
                                <tr>
                                    <td scope="col">HFO Bunker</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">1.97</td>
                                </tr>
                                <tr>
                                    <td scope="col">HFO Service</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">6.52</td>
                                </tr>
                                <tr>
                                    <td scope="col">HFO Setting</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 55%"
                                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">6.70</td>
                                </tr>
                                <tr>
                                    <td scope="col">FWD HFO</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 40%"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">3.56</td>
                                </tr>
                                <tr>
                                    <td scope="col">LS HFO Bunker</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">0.86</td>
                                </tr>
                                <tr>
                                    <td scope="col">LS HFO Service</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"
                                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">0.20</td>
                                </tr>
                                <tr>
                                    <td scope="col">LS HFO Setling</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">1.85</td>
                                </tr>
                                <tr>
                                    <td scope="col">MDO Service</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar" style="width: 40%"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">0.81</td>
                                </tr>
                                <tr>
                                    <td scope="col">MDO Storage</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar" style="width: 25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">0.39</td>
                                </tr>
                                <tr>
                                    <td scope="col">IGG Fuel</td>
                                    <td scope="col" colspan="8" style="vertical-align: middle;">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td scope="col" class="text-end">2.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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