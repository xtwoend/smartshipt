<template>
    <div>
        <chart-svg :path="svgPath" :svgData="data" :height="550"></chart-svg>
        <div v-if="debug">
            {{  data  }}
        </div>
    </div>
</template>

<script>
import ChartSvg  from '../charts/svg.vue';
export default {
    props: {
        svgPath: String,
        url: String,
        group: String,
        debug: {
            type: Boolean,
            default: false
        }
    },
    components: {
        ChartSvg
    },
    data() {
        return {
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
            let data = await axios.get(this.url).then(res => res.data);
            if(data) {
                this.data = data
                let x = ['id', 'fleet_id', 'created_at', 'updated_at', 'terminal_time'];
                Object.keys(data).forEach(key => {
                    if(! x.includes(key)) {
                        this.data[key + '_bar'] = data[key] * 1000;
                    }
                })
            }
        },
    }
}
</script>

<style lang="scss" scoped>

</style>