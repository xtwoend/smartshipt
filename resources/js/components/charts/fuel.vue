<template>
    <div class="row">
        <div class="col position-relative">
            <highcharts :options="fuelOptions" :callback="chartCallback"></highcharts>
            <div class="text-center fw-bold title-fuel" style="position: absolute;bottom: 20%;left: 0;right: 0;">Total HFO (KL)</div>
            <div class="text-center fw-bold" style="position: absolute;bottom: 15%;left: 0;right: 0;">15.08 KL</div>
        </div>
        <div class="col position-relative">
            <highcharts :options="fuelOptions" :callback="chartCallback"></highcharts>
            <div class="text-center fw-bold title-fuel" style="position: absolute;bottom: 20%;left: 0;right: 0;">Total LS HFO (KL)</div>
            <div class="text-center fw-bold" style="position: absolute;bottom: 15%;left: 0;right: 0;">2.94</div>
        </div>
        <div class="col position-relative">
            <highcharts :options="fuelOptions" :callback="chartCallback"></highcharts>
            <div class="text-center fw-bold title-fuel" style="position: absolute;bottom: 20%;left: 0;right: 0;">Total MDO (KL)</div>
            <div class="text-center fw-bold" style="position: absolute;bottom: 15%;left: 0;right: 0;">1.22</div>
        </div>
        <div class="col position-relative">
            <highcharts :options="fuelOptions" :callback="chartCallback"></highcharts>
            <div class="text-center fw-bold title-fuel" style="position: absolute;bottom: 20%;left: 0;right: 0;">Total HSD (KL)</div>
            <div class="text-center fw-bold" style="position: absolute;bottom: 15%;left: 0;right: 0;">2.01</div>
        </div>
        <div class="col position-relative">
            <highcharts :options="fuelOptions" :callback="chartCallback"></highcharts>
            <div class="text-center fw-bold title-fuel" style="position: absolute;bottom: 20%;left: 0;right: 0;">Total (KL)</div>
            <div class="text-center fw-bold" style="position: absolute;bottom: 15%;left: 0;right: 0;">21.25</div>
        </div>
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
    methods: {
      chartCallback(chart) {
        if (!chart.renderer.forExport) {
          setInterval(function() {
            var point = chart.series[0].points[0],
              newVal,
              inc = Math.round((Math.random() - 0.5) * 20);
  
            newVal = point.y + inc;
            if (newVal < 0 || newVal > 200) {
              newVal = point.y - inc;
            }
  
            point.update(newVal);
          }, 3000);
        }
      }
    },
    data() {
      return {
        fuelOptions: {
          chart: {
            type: "gauge",
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
          },
  
          title: {
            useHTML: true,
            text:  "<img src='https://cdn-icons-png.flaticon.com/512/710/710296.png' height='18px' alt='' />",
            y: 180
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
                backgroundColor: "#FFF",
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
            min: 0,
            max: 32,
  
            minorTickInterval: "auto",
            minorTickWidth: 0,
            minorTickLength: 10,
            minorTickPosition: "inside",
            minorTickColor: "#fff",
  
            tickPixelInterval: 32,
            tickWidth: 5,
            tickPosition: "inside",
            tickLength: 20,
            tickColor: "#0A2647",
            labels: {
              step: 16,
              distance: 10,
              enabled: false
            },
            title: {
              text: "",
              y: 20
            },
            plotBands: [
              {
                from: 0,
                to: 4,
                color: "#0A2647",
              },
              {
                from: 4,
                to: 8,
                color: "#0A2647",
              },
              {
                from: 8,
                to: 12,
                color: "#0A2647",
              },
              {
                from: 12,
                to: 16,
                color: "#0A2647",
              },
              {
                from: 16,
                to: 20,
                color: "#0A2647",
              },
              {
                from: 20,
                to: 24,
                color: "#0A2647",
              },
              {
                from: 24,
                to: 28,
                color: "#0A2647",
              },
              {
                from: 28,
                to: 32,
                color: "#0A2647",
              }
            ]
          }],
  
          series: [
            {
              name: "Speed",
              data: [20],
              tooltip: {
                valueSuffix: " "
              }
            }
          ]
        },
      };
    }
  };
  </script>
  
  <style lang="scss" scoped>
    .highcharts-axis-line{
        display: none;
    }
    .highcharts-credits{
        display: none;
    }
    .highcharts-dial{
        fill: #DF0000;
    }
    .highcharts-axis-labels{
      display: none;
    }
    .title-fuel{
      position: relative;

      &:before{
        content: 'E';
        display: inline-block;
        position: absolute;
        width: 18px;
        height: 18px;
        top: -140%;
        left: 20%;
        background: transparent;
        z-index: 3;
      }

      &:after{
        content: 'F';
        display: inline-block;
        position: absolute;
        width: 18px;
        height: 18px;
        top: -140%;
        right: 20%;
        background: transparent;
        z-index: 3;
      }
    }
</style>