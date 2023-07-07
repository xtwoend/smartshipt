<template>
    <div>
        <chart-svg path="/svg/engine-2.svg" :svgData="data" :height="550"></chart-svg>
    </div>
</template>

<script>
import ChartSvg  from '../charts/svg.vue';
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
            let engine = this.fleet.engine;
            if(engine) {
                this.data = engine
                let x = ['id', 'fleet_id', 'created_at', 'updated_at', 'terminal_time'];
                Object.keys(engine).forEach(key => {
                    if(! x.includes(key)) {
                        this.data[key + '_bar'] = engine[key] * 1000;
                    }
                })
                this.data.fleet_name = this.fleet.name
            }
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
