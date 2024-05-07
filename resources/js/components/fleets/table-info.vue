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
                            <a href="#" v-if="a.condition == 'ABNORMAL'" @click="openRecomend(a)" data-bs-toggle="tooltip" data-bs-placement="top" :title="buildTooltip(a, data[a.data])">
                                <img src="/icon/danger.svg" height="16" />
                            </a>
                            {{ $filters.number(data[a.data]) }} <span v-html="a.unit"></span>
                        </td>
                        <td v-else>{{ data[a.data] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Teleport to="#info">
            <SideInfo v-show="infoOpened" :info="info" @close="infoOpened=false"></SideInfo>
        </Teleport>
    </div>
</template>

<script>
import { Tooltip } from 'bootstrap'
import {Teleport} from 'vue'
import SideInfo from './side-info.vue'
export default {
    components: {SideInfo, Teleport},
    props: {
        url: String,
        mapping: Array
    },
    data () {
        return {
            data: null,
            infoOpened: false,
            info: null
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
    },
    methods: {
        async fetchData() {
            this.data = await axios.get(this.url).then(res => res.data);
        },
        isNumber(val) {
            return isNaN(val);
        },
        openRecomend(a) {
            // this.infoOpened = true
            this.info = a
        },
        buildTooltip(a, val) {
            if(a.normal > val) {
                return 'IS VERY LOW';
            }

            if(a.danger < val) {
                return 'IS VERY HIGH';
            }
            return 'NORMAL'
        }
    }
}

</script>

<style lang="scss" scoped></style>