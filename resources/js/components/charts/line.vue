<template>
    <Chart :options="chartOptions" :constructorType="'stockChart'" />
  </template>
  
  
  <script>
  import { Chart } from "highcharts-vue";
  import Highcharts from "highcharts";
import Accessbility from "highcharts/modules/accessibility";
import Json from 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/range.json';

Accessbility(Highcharts);
  
  export default {
    name: "line",
    components: {
      Chart,
    },
    data() {
      return {
        chartOptions: {
            chart: {
                type: 'arearange',
                zoomType: 'x',
                scrollablePlotArea: {
                    minWidth: 600,
                    scrollPositionX: 1
                }
            },

            title: {
                text: 'Temperature variation by day'
            },

            xAxis: {
                type: 'datetime',
                accessibility: {
                    rangeDescription: 'Range: Jan 1st 2017 to Dec 31 2017.'
                }
            },

            yAxis: {
                title: {
                    text: null
                }
            },

            tooltip: {
                crosshairs: true,
                shared: true,
                valueSuffix: '°C',
                xDateFormat: '%A, %b %e'
            },

            legend: {
                enabled: false
            },

            series: [{
                name: 'Temperatures',
                data: Json
            }]
        },
      };
    },
  };
  </script>