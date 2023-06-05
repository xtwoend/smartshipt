<template>
    <div>
        <highcharts :options="options" :callback="callback"></highcharts>
    </div>
</template>

<script>

import { Chart } from "highcharts-vue";

export default {
    props: {
        value: Number,
        title: String
    },
    components: {
        highcharts: Chart
    },
    watch: {
        value: function(now, old) {
            this.options.series[0].data = [now];
        }
    },
    data() {
        return {
            options: {
                chart: {
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: 300
                },

                title: {
                    text: ''
                },

                pane: {
                    startAngle: 0,
                    endAngle: 360,
                    background: [
                        {
                            backgroundColor: {
                                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                stops: [[0, "#FFF"], [1, "#FFF"]]
                            },
                            borderWidth: 0,
                            outerRadius: "109%"
                        },
                        {
                            backgroundColor: {
                                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                stops: [[0, "#FFF"], [1, "#FFF"]]
                            },
                            borderWidth: 0,
                            outerRadius: "107%"
                        },
                        {
                            borderWidth: 0,
                            backgroundColor: "#E9EDED",
                        },
                        {
                            backgroundColor: "#FFF",
                            borderWidth: 0,
                            outerRadius: "105%",
                            innerRadius: "103%"
                        }
                    ]
                },
                // the value axis
                yAxis: [{
                    title: {
                        text: this.title,
                    },
                    min: 1,
                    max: 360,
                    lineColor: '#333',
                    offset: -20,
                    tickInterval: 30,
                    labels: {
                        step: 1,
                        distance: 5,
                        rotation: 'auto',
                        // format: "{value} &deg;",
                    }
                }],

                series: [{
                    name: this.title,
                    yAxis: 0,
                    data: [this.value],
                    dial: {
                        radius: '88%',
                        baseWidth: 10,
                        baseLength: '0%',
                        rearLength: 0,
                        borderWidth: 1,
                        borderColor: '#9A0000',
                        backgroundColor: '#CC0000',
                    },
                    tooltip: {
                        valueSuffix: '°'
                    }
                }]
            }
        }
    }
}
</script>

<style lang="scss" scoped></style>