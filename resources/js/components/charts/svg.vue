<template>
    <div>
        <div id="scada-svg" class="scada" ref="cnsvg" :style="{height: this.height + 'px'}"></div>
    </div>
</template>

<script>
export default {
    props: {
        path: String,
        svgData: Object,
        height: Number
    },
    data () {
        return {
            scadavis: null,
            tags: [],
        }
    },
    async mounted () {
        await this.init()
        Object.keys(this.svgData).forEach(key => {
            that.setValue(key, this.svgData[key])
        });
    },
    created() {
        window.addEventListener("resize", this.resize);
    },
    destroyed() {
        window.removeEventListener("resize", this.resize);
    },
    watch: {
        svgData: function(val, old) {
            let that = this
            Object.keys(val).forEach(key => {
                that.setValue(key, val[key])
            });
        }
    },
    methods: {
        async init() {
            this.scadavis = await scadavisInit({
                container: "scada-svg",
                svgurl: this.path
            })
            this.scadavis.enableTools(false, true);
            this.scadavis.hideWatermark()
            this.tags = this.scadavis.getTagsList().split(",")
            this.tags.forEach(tag => {
                this.scadavis.setValue(tag, 0);
            });
            this.resize()
        },
        resize(){
            this.scadavis.zoomToOriginal()
            let svelem = this.$refs.cnsvg
            this.scadavis.zoomTo(1.0 * ((svelem.clientWidth < svelem.clientHeight)? svelem.clientWidth/600 : svelem.clientHeight/600) );
        },
        setValue(tag, val) {
            if(this.scadavis){
                this.scadavis.setValue(tag, val);
            }
        },
    }
}
</script>

<style lang="scss">
.scada {
    height: 100%;
    width: 100%;
}
iframe {
    border: 0;
    height: 100%;
    width: 100%;
}
</style>