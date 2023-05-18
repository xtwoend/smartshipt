<template>
    <div class="row">
        <div class="col-3">
            <highcharts :options="chartOptions" :callback="chartCallback"></highcharts>
        </div>
        <div class="col-3">
            <highcharts :options="chartOptions2" :callback="chartCallback"></highcharts>
        </div>
        <div class="col-3">
            <highcharts :options="chartOptions3" :callback="chartCallback"></highcharts>
        </div>
        <div class="col-3">
            <highcharts :options="chartOptions4" :callback="chartCallback"></highcharts>
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
        chartOptions: {
          chart: {
            type: "gauge",
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
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
            min: 0,
            max: 32,
  
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
              text: "Speed",
              y: 150
            },
            plotBands: [
              {
                from: 0,
                to: 4,
                color: "#576D7E",
                thickness: 40,
              },
              {
                from: 4,
                to: 8,
                color: "#34485C",
                thickness: 40
              },
              {
                from: 8,
                to: 12,
                color: "#60C5B8",
                thickness: 40
              },
              {
                from: 12,
                to: 16,
                color: "#25B39E",
                thickness: 40
              },
              {
                from: 16,
                to: 20,
                color: "#FCD062",
                thickness: 40
              },
              {
                from: 20,
                to: 24,
                color: "#F8B84E",
                thickness: 40
              },
              {
                from: 24,
                to: 28,
                color: "#F17F53",
                thickness: 40
              },
              {
                from: 28,
                to: 32,
                color: "#F05542",
                thickness: 40
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
        chartOptions2: {
          chart: {
            type: "gauge",
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
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
            min: 0,
            max: 32,
  
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
              text: "Wind Speed",
              y: 150
            },
            plotBands: [
              {
                from: 0,
                to: 4,
                color: "#576D7E",
                thickness: 40,
              },
              {
                from: 4,
                to: 8,
                color: "#34485C",
                thickness: 40
              },
              {
                from: 8,
                to: 12,
                color: "#60C5B8",
                thickness: 40
              },
              {
                from: 12,
                to: 16,
                color: "#25B39E",
                thickness: 40
              },
              {
                from: 16,
                to: 20,
                color: "#FCD062",
                thickness: 40
              },
              {
                from: 20,
                to: 24,
                color: "#F8B84E",
                thickness: 40
              },
              {
                from: 24,
                to: 28,
                color: "#F17F53",
                thickness: 40
              },
              {
                from: 28,
                to: 32,
                color: "#F05542",
                thickness: 40
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
        chartOptions3: {
          chart: {
            type: "gauge",
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
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
            min: 0,
            max: 32,
  
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
              text: "RPM",
              y: 150
            },
            plotBands: [
              {
                from: 0,
                to: 4,
                color: "#576D7E",
                thickness: 40,
              },
              {
                from: 4,
                to: 8,
                color: "#34485C",
                thickness: 40
              },
              {
                from: 8,
                to: 12,
                color: "#60C5B8",
                thickness: 40
              },
              {
                from: 12,
                to: 16,
                color: "#25B39E",
                thickness: 40
              },
              {
                from: 16,
                to: 20,
                color: "#FCD062",
                thickness: 40
              },
              {
                from: 20,
                to: 24,
                color: "#F8B84E",
                thickness: 40
              },
              {
                from: 24,
                to: 28,
                color: "#F17F53",
                thickness: 40
              },
              {
                from: 28,
                to: 32,
                color: "#F05542",
                thickness: 40
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
        chartOptions4: {
          chart: {
            type: "gauge",
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
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
            min: 0,
            max: 32,
  
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
              text: "Turbo Charger",
              y: 150
            },
            plotBands: [
              {
                from: 0,
                to: 4,
                color: "#576D7E",
                thickness: 40,
              },
              {
                from: 4,
                to: 8,
                color: "#34485C",
                thickness: 40
              },
              {
                from: 8,
                to: 12,
                color: "#60C5B8",
                thickness: 40
              },
              {
                from: 12,
                to: 16,
                color: "#25B39E",
                thickness: 40
              },
              {
                from: 16,
                to: 20,
                color: "#FCD062",
                thickness: 40
              },
              {
                from: 20,
                to: 24,
                color: "#F8B84E",
                thickness: 40
              },
              {
                from: 24,
                to: 28,
                color: "#F17F53",
                thickness: 40
              },
              {
                from: 28,
                to: 32,
                color: "#F05542",
                thickness: 40
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
        }
      };
    }
  };
  </script>
  
  <style>
    .highcharts-axis-line{
        display: none;
    }
    .highcharts-credits{
        display: none;
    }
</style>