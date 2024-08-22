<template>
    <div class="row">
        <div class="col-12">
            <div class="table-title mb-4 mt-2">
                <h6>{{ title }}</h6>
            </div>
            <div class="row justify-content-end">
                <div class="col-6">
                    <dropdown-select :options="columns" @checked="selected" :default="defColumns"></dropdown-select>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-end gap-1">
                        <!-- <VueDatePicker v-model="params.from"></VueDatePicker>
                        <VueDatePicker v-model="params.to"></VueDatePicker> -->
                        <date-range :from="params.from" :to="params.to" @change="updateDate"></date-range>
                        <select class="form-control w-5 bordered" v-model="params.interval">
                            <option value="5">5m</option>
                            <option value="30">30m</option>
                            <option value="60">1 H</option>
                            <option value="1440">1 D</option>
                        </select>
                        <button @click="showChart" class="btn btn-primary">SHOW</button>
                        <button @click="download" class="btn btn-primary">Download Data</button>
                    </div>
                </div>
            </div>
            <Chart ref="chart" :options="options" :constructorType="'stockChart'" />
        </div>
    </div>
</template>

<script>
import { Chart } from "highcharts-vue";
import Highcharts from "highcharts";
import Accessbility from "highcharts/modules/accessibility";
import Exporting from "highcharts/modules/exporting";
import colors from '../../libs/colors';
import DropdownSelect from '../widgets/dropdown.vue';
import DateRange from '../widgets/daterange.vue'
import _ from 'lodash';

Accessbility(Highcharts);
Exporting(Highcharts);

export default {
    components: {
        Chart,
        DateRange,
        DropdownSelect
    },
    props: {
        url: String,
        title: String,
        columns: Array,
    },
    data() {
        return {
            params: {
                from: (new Date(new Date().setDate(new Date().getDate() - 1 ))).toISOString().split('T')[0].replace(/-/g, '-'),
                to: (new Date()).toISOString().split('T')[0].replace(/-/g, '-'),
                interval: 60
            },
            defColumns: [],
            items: this.columns,
            options: {
                chart: {
                    // type: 'spline',
                    zoomType: 'x'
                },
                exporting: {
                    filename: this.title,
                    sourceWidth: 1600,
                    sourceHeight: 480,
                    scale: 1,
                    // chartOptions: {
                    //     subtitle: null
                    // }
                },
                time: {
                    useUTC: false,
                    timezone: 'Asia/Jakarta'
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
                    plotLines: [{
                        value: 0,
                        width: 2,
                        color: 'silver'
                    }]
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
        }
    },
    mounted() {
        this.defColumns = _.sampleSize(this.columns, 5);
    },
    methods: {
        download() {
            let select = [];
            this.items.forEach((col, index) => {
                select[index] = col.data;
            })
            this.params.select = select;

            const queryString = new URLSearchParams(this.params).toString();
            let url = this.url + '/export?' + queryString + '&time=' + Date.now();
            window.open(url)
        },
        selected(e) {
            this.items = e
            this.showChart()
        },
        updateDate(e) {
            this.params.from = e.from
            this.params.to = e.to
        },
        async showChart() {
            
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
                            fontSize: '10px',
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

                if (col.range) {
                    label[index].min = col.range[0];
                    label[index].max = col.range[1];
                }

                series[index] = {
                    id: col.data,
                    row: col.data,
                    threshold: col.max_normal,
                    yAxis: index,
                    type: col.type ? col.type : 'spline',
                    name: col.text,
                    color: randColor,
                    lineWidth: 1,
                    data: []
                };

                select[index] = col.data;
            })

            if(this.items.length == 1) {
                let ix = this.items[0]
                label[0].plotLines = [
                    {
                        value: ix.max_normal,
                        color: 'green',
                        dashStyle: 'shortdash',
                        width: 2,
                        label: {
                            text: 'Treshold'
                        }
                    }
                ]
            }

            this.options.series = series;
            this.options.yAxis = label;
            this.params.select = select;

            let res = await axios.get(this.url, { params: this.params }).then(res => res.data);

            res.forEach(row => {
                let time = parseInt((new Date(row.terminal_time).getTime()).toFixed(0));
                this.options.series.forEach((s, index) => {
                    let dt = row[s.row];
                    // if(s.row == 'no_ops') {
                    //     this.options.series[index].data.push([time, s.threshold])
                    // }else{
                        this.options.series[index].data.push([time, dt]);
                    // }
                })
            })

            this.$refs.chart.chart.hideLoading();
        }
    }
}
</script>

<style lang="scss" scoped></style>