<template>
    <div>
        <highcharts :options="options"></highcharts>
    </div>
</template>

<script>

import { Chart } from "highcharts-vue";

export default {
    props: {
        data: Array,
        title: String
    },
    components: {
        highcharts: Chart
    },
    watch: {
        data: function (now, old) {
            console.log(now)
            // this.options.series[0].data = [now];
        }
    },
    data() {
        return {
            options: {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    height: 300
                },

                title: {
                    text: ''
                },

                tooltip: {
                    pointFormat: '{series.name}: <b>{point.count}</b>'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },

                series: [{
                    name: 'Fleets',
                    colorByPoint: true,
                    data: [
                        {
                            name: 'Edge',
                            y: 12.82
                        }, {
                            name: 'Firefox',
                            y: 4.63
                        }, {
                            name: 'Safari',
                            y: 2.44
                        }, {
                            name: 'Internet Explorer',
                            y: 2.02
                        }, {
                            name: 'Other',
                            y: 3.28
                        }
                    ]
                }]
            }
        }
    }
}
</script>

<style lang="scss" scoped></style>