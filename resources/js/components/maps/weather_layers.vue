<template>
    <div class="weathers position-absolute" ref="cWeather">
        <div class="card" style="height: 100%">
            <div class="card-header search">
                Weathers
                <div class="card-actions btn-actions">
                    <a href="#" class="btn-action" @click="searchExpand">
                        <svg v-if="!isExpand" xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="15 6 9 12 15 18"></polyline>
                        </svg>
                        <svg v-if="isExpand" xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card-body card-body-scrollable card-body-scrollable-shadow weather-body" ref="searchBody">
                <div class="divide-y pointer">
                    <div v-for="(layer, index) in layers">
                        <label :for="index">
                            <input type="checkbox" :id="index" :value="layer.code" v-model="selected">
                            {{ layer.code }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isExpand: false,
            selected: [],
            layers: [],
            codes: [
                'boundaries',
                'cloud-cover',
                // 'dew-points',
                // 'dew-points-text',
                // 'feels-like',
                // 'feels-like-text',
                // 'heat-index',
                // 'heat-index-text',
                // 'precip',
                // 'precip-accum',
                // 'precip-accum-text',
                // 'precip-text',
                // 'pressure-msl',
                // 'pressure-msl-contour',
                // 'pressure-msl-text',
                'radar',
                // 'snow',
                // 'snow-accum',
                // 'snow-accum-text',
                // 'snow-depth',
                // 'snow-text',
                // 'temperatures',
                // 'temperatures-24hr-change',
                // 'temperatures-24hr-change-text',
                // 'temperatures-contour',
                // 'temperatures-max',
                // 'temperatures-max-text',
                // 'temperatures-min',
                // 'temperatures-min-text',
                // 'temperatures-text',
                // 'wind-barbs',
                // 'wind-chill',
                // 'wind-chill-text',
                'wind-dir',
                // 'wind-gusts',
                // 'wind-gusts-text',
                'wind-particles',
                // 'wind-particles-arrow',
                'wind-speeds',
                // 'wind-speeds-contour',
                // 'wind-speeds-text',
                // 'wave-dir',
                // 'wave-heights',
                'wave-particles',
                // 'wave-periods',
                // 'swell-dir',
                // 'swell-heights',
                // 'swell-particles',
                // 'swell-periods',
                // 'swell2-dir',
                // 'swell2-heights',
                // 'swell2-particles',
                // 'swell2-periods',
                // 'swell3-dir',
                // 'swell3-heights',
                // 'swell3-particles',
                // 'swell3-periods',
                // 'lightning-all',
                // 'lightning-all-icons',
                // 'lightning-flash',
                // 'lightning-strikes',
                // 'lightning-strikes-icons',
                // 'stormcells',
                // 'stormcells-cones',
                // 'stormcells-heat',
                // 'stormcells-positions',
                // 'stormcells-tracks',
                // 'stormreports',
                // 'stormreports-heat'
            ]
        }
    },
    mounted() {
        this.codes.forEach(code => {
            this.layers.push({
                code: code,
                show: false
            })
        })
    },
    watch: {
        selected(val) {
            this.$emit('selected', val)
        },
    },
    methods: {
        searchExpand () {
            this.isExpand = ! this.isExpand

            let el = this.$refs.searchBody
            if(this.isExpand) {
                el.style.display = 'block';
                this.$refs.cWeather.style.bottom = '240px';            
            }else {
                el.style.display = 'none';
                this.$refs.cWeather.style.bottom = 'unset'; 
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.weathers {
    width: 370px;
    top: 230px;
    right: 20px;
    transition: 0.3s;
    z-index: 2;
    .card {
        background: rgba(255, 255, 255, 0.7) !important;
        .weather-body {
            display: none;
            padding: 10px;
        }

        .pointer {
            cursor: pointer;
        }
    }
}

</style>