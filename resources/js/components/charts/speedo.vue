<template>
    <div>
        <highcharts :options="options"></highcharts>
    </div>
</template>

<script>
import { Chart } from "highcharts-vue";
import Highcharts from "highcharts";
import hcMore from "highcharts/highcharts-more";  
hcMore(Highcharts);

export default {
    components: {
        highcharts: Chart
    },
    props: {
        min: {
            type: Number,
            default: 0
        },
        max: {
            type: Number,
            default: 32
        },
        value: {
            type: Number,
            default: 0
        },
        title: String
    },
    data() {
        return {
            options: {
                chart: {
                    type: "gauge",
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: 300
                },

                title: {
                    text: ""
                },

                pane: {
                    startAngle: -120,
                    endAngle: 120,
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
                            // default background
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
                    min: this.min,
                    max: this.max,

                    minorTickInterval: "auto",
                    minorTickWidth: 0,
                    minorTickLength: 10,
                    minorTickPosition: "inside",
                    minorTickColor: "#666",

                    tickPixelInterval: 30,
                    tickWidth: 0,
                    tickPosition: "inside",
                    tickLength: 10,
                    tickColor: "#666",
                    labels: {
                        step: 2,
                        distance: -50,
                    },
                    title: {
                        text: this.title,
                        y: 150
                    },
                    plotBands: [
                        {
                            from: 0,
                            to: (this.max / 8),
                            color: "#576D7E",
                            thickness: 40,
                        },
                        {
                            from: (this.max / 8),
                            to: ((this.max / 8) * 2),
                            color: "#34485C",
                            thickness: 40
                        },
                        {
                            from: (this.max / 8) * 2,
                            to: (this.max / 8) * 3,
                            color: "#60C5B8",
                            thickness: 40
                        },
                        {
                            from: (this.max / 8) * 3, 
                            to: (this.max / 8) * 4,
                            color: "#25B39E",
                            thickness: 40
                        },
                        {
                            from: (this.max / 8) * 4,
                            to: (this.max / 8) * 5,
                            color: "#FCD062",
                            thickness: 40
                        },
                        {
                            from: (this.max / 8) * 5,
                            to: (this.max / 8) * 6,
                            color: "#F8B84E",
                            thickness: 40
                        },
                        {
                            from: (this.max / 8) * 6,
                            to: (this.max / 8) * 7,
                            color: "#F17F53",
                            thickness: 40
                        },
                        {
                            from: (this.max / 8) * 7,
                            to: (this.max / 8) * 8,
                            color: "#F05542",
                            thickness: 40
                        },
                    ]
                }],
                series: [
                    {
                        name: this.title,
                        data: [this.value],
                        tooltip: {
                            valueSuffix: " "
                        }
                    }
                ]
            },
        }
    },
    methods: {
        // 
    },
    watch: {
        value: function(now, old) {
            this.options.series[0].data = [now];
        }
    }
}
</script>

<style lang="scss" scoped></style>