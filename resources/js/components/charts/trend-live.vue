<template>
    <div class="row">
        <div class="col-12">
            <div class="table-title mb-4 mt-2">
                <h6>{{ title }}</h6>
            </div>
            <div class="row justify-content-end">
                <div class="col-12">
                    <dropdown-select :options="columns" @checked="selected" :default="defColumns"></dropdown-select>
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
import colors from '../../libs/colors';
import DropdownSelect from '../widgets/dropdown.vue';
import DateRange from '../widgets/daterange.vue';
import _ from 'lodash';

Accessbility(Highcharts);

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
        socketConfig: Object,
        fleet: Object,
    },
    data() {
        return {
            socket: null,
            connected: false,
            defColumns: [],
            params: {},
            items: this.columns,
            options: {
                chart: {
                    type: 'spline',
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
    async mounted() {
        this.socket = io(this.socketConfig.url, {transports: ["websocket"] });
        this.socket.on('connect', () => this.connected = true);
        this.socket.on('disconnect', () => this.connected = false);
        this.socket.emit('subscribe', `fleet-${this.fleet.id}`);
        this.socket.on(this.socketConfig.event, this.onMessage);

        this.defColumns = await _.sampleSize(this.columns, 3)

        await this.showChart()
    },
    methods: {
        selected(e) {
            this.items = e
            this.showChart()
        },
        onMessage(e) {
            let row = JSON.parse(e.toString());
            let time = parseInt((new Date(row.terminal_time).getTime()).toFixed(0)); //row.unix_time;
            // remove first el
            this.options.series[index].data.shift();
            // add el
            this.options.series.forEach((s, index) => {
                let dt = row[s.row];
                this.options.series[index].data.push([time, dt]);
            })
            
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
                    yAxis: index,
                    type: col.type ? col.type : 'spline',
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

            let res = await axios.get(this.url).then(res => res.data);
            
            res.forEach(row => {
                let time = parseInt((new Date(row.terminal_time).getTime()).toFixed(0)); //row.unix_time;
                this.options.series.forEach((s, index) => {
                    let dt = row.data[s.row];
                    this.options.series[index].data.push([time, dt]);
                })
            })

            this.$refs.chart.chart.hideLoading();
        }
    }
}
</script>

<style lang="scss" scoped></style>