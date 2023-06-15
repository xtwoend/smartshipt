<template>
    <div v-if="fleet">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <chart-svg path="/svg/bunker_bargraph.svg" :svgData="data" :height="550"></chart-svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChartSvg from '../charts/svg.vue';
export default {
    props: {
        url: String,
    },
    components: { ChartSvg },
    data() {
        return {
            fleet: null,
            data: {}
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
            let cargo = this.fleet.cargo_data;
            if(cargo) {
                this.data = cargo
                this.data.fleet_name = this.fleet.name
            }
        },
    }
}
</script>

<style lang="scss"></style>
