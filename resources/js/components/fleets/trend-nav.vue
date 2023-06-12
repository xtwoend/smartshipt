<template>
    <Chart ref="chart" :options="options" :constructorType="'stockChart'" />
</template>
  
  
<script>
import { Chart } from "highcharts-vue";
import Highcharts from "highcharts";
import Accessbility from "highcharts/modules/accessibility";
import colors from '../../libs/colors';

Accessbility(Highcharts);

export default {
    name: "spline",
    props: {
        params: Object,
        fleet: Object,
        default: Array
    },
    components: {
        Chart,
    },
    methods: {
        async show() {
            this.$refs.chart.chart.showLoading();

            let series = [];
            let label = [];
            let select = [];
            this.items.forEach((col, index) => {
                let randColor = colors[index]; 
                label[index] = {
                    title: {
                        text: col.text,
                        style: {
                            color: randColor,
                            fontSize: '12px',
                        }
                    },
                    lineColor: randColor,
                    labels: {
                        style: {
                            color: randColor,
                        },
                        align: 'left',
                        x: 14
                    },
                    lineWidth: 1,
                    opposite: true,
                };

                if(col.range) {
                    label[index].min = col.range[0];
                    label[index].max = col.range[1];
                }

                series[index] = {
                    id: col.data,
                    row: col.data,
                    yAxis: index,
                    type: col.type? col.type : 'spline',
                    name: col.text,
                    color: randColor,  
                    lineWidth: 1,
                    data: []
                };

                select[index] = col.data;
            })

            this.options.series = series;
            this.options.yAxis = label;
            this.params.select = select;

            let res = await axios.get(`/api/fleet/${this.fleet.id}/nav/trend`, {params: this.params}).then(res => res.data);
            res.forEach(row => {
                let time = row.unix_time;
                this.options.series.forEach((s, index) => {
                    let dt = row[s.row];
                    this.options.series[index].data.push([time, dt]);
                })
            })

            this.$refs.chart.chart.hideLoading();
        },
        selected(e){
            this.items = e
            this.show()
        }
    },
    data() {
        return {
            items: this.default,
            options: {
                chart: {
                    type: 'spline'
                },
                time: {
                    useUTC: false
                },
                title: {
                    text: ''
                },
                xAxis: {
                    type: 'datetime',
                    labels: {
                        overflow: 'justify'
                    }
                },
                yAxis: {
                    minorGridLineWidth: 0,
                    gridLineWidth: 0,
                    alternateGridColor: null,
                },
                plotOptions: {
                    spline: {
                        lineWidth: 4,
                        states: {
                            hover: {
                                lineWidth: 5
                            }
                        },
                        marker: {
                            enabled: false
                        }
                    }
                },
                series: [],
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            },
        };
    },
};
</script>