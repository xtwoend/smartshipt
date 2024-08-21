<template>
    <div class="row">
        <div class="col-12">
            <div class="table-title">
                <h6>Data Information</h6>
            </div>
            <table class="table table-sm" v-if="data">
                <tbody>
                    <tr>
                        <th scope="row">•</th>
                        <td>Updated at</td>
                        <td class="text-end">{{ data.terminal_time }}</td>
                    </tr>
                    <tr v-for="a in mapping" :key="a.data">
                        <th scope="row">•</th>
                        <td>{{ a.text }}</td>
                        <td v-if="isNumber(a.data)" class="text-end">
                            <a href="#" v-if="a.condition == 'ABNORMAL' && a.is_ams" @click="openRecomend(a)" data-bs-toggle="tooltip" data-bs-placement="top" :title="buildTooltip(a, data[a.data])">
                                <img src="/icon/danger.svg" height="16" />
                            </a>
                            {{ $filters.number(data[a.data]) }} <span v-html="a.unit"></span>
                        </td>
                        <td v-else>{{ data[a.data] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <Teleport to="body">
        <div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="info_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="info_modal">Status Detail</h5>
                        <button type="button" class="close" @click="modal.hide()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <template v-if="info">
                        <h4>Item Name:</h4>
                        <p>{{ info.name  }}</p>
                        <br>
                        <div v-if="is_low" v-html="info.low_desc"></div>
                        <div v-if="! is_low" v-html="info.high_desc"></div>
                        </template>
                        <template v-else>
                        <h4>No Information detail</h4>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script>
import { Tooltip, Modal } from 'bootstrap'
import { Teleport } from 'vue'
export default {
    components: {Teleport},
    props: {
        url: String,
        mapping: Array
    },
    data () {
        return {
            data: null,
            infoOpened: false,
            modal: null,
            info: null,
            is_low: false
        }
    },
    created() {
        this.fetchData()
    },
    mounted() {
        setInterval(() => this.fetchData(), 5 * 1000)
        new Tooltip(document.body, {
            selector: "[data-bs-toggle='tooltip']",
        })
        this.modal = new Modal('#info_modal', {})
    },
    methods: {
        async fetchData() {
            this.data = await axios.get(this.url).then(res => res.data);
        },
        isNumber(val) {
            return isNaN(val);
        },
        async openRecomend(a) {
            // this.infoOpened = true
            let fleetId = a.fleet_id;
            let sensorName = a.data;

            this.info = await axios.get('/api/docs', {params: {fleet_id: fleetId, sensor_name: sensorName}}).then(res => res.data)

            this.modal.show();
        },
        buildTooltip(a, val) {
            
            if(a.reverse) {
                if(a.normal < val) {
                    this.is_low = true;
                    return 'IS VERY LOW';
                }

                if(a.danger > val) {
                    this.is_low = false;
                    return 'IS VERY HIGH';
                }
            }else{
                if(a.normal > val) {
                    this.is_low = true;
                    return 'IS VERY LOW';
                }

                if(a.danger < val) {
                    this.is_low = false;
                    return 'IS VERY HIGH';
                }
            }
            return 'NORMAL'
        }
    }
}

</script>

<style lang="scss" scoped></style>