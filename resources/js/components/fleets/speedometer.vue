<template>
    <div class="row">
        <div class="col-3">
            <speedo-meter :value="fleet.navigation.sog" :max="32" title="Speed (SOG)"></speedo-meter>
        </div>
        <div class="col-3">
            <speedo-meter :value="fleet.navigation.wind_speed" :max="80" :title="scaleBeafort(fleet.navigation.wind_speed)"></speedo-meter>
        </div>
        <div class="col-3">
          <speedo-meter :value="fleet.engine.main_engine_speed" :max="20" title="RPM"></speedo-meter>
        </div>
        <div class="col-3">
          <speedo-meter :value="fleet.engine.turbo_charger_speed_no_1 > 0? fleet.engine.turbo_charger_speed_no_1 / 1000 : 0" :max="20" title="TURBO 1"></speedo-meter>
        </div>
    </div>
  </template>
  
  <script>
  import SpeedoMeter from '@/components/charts/speedo.vue';
  export default {
    props: {
      url: String,
      fleet: Object
    },
    components: {
      SpeedoMeter: SpeedoMeter
    },
    methods: {
      scaleBeafort(wind) {
        let text = '';
        if(wind <= 1)
            text = 'Calm'
        else if(wind > 1 && wind < 3.9)
            text = 'Light Air'
        else if(wind > 4 && wind < 6.9)
            text = 'Light Breeze'
        else if(wind > 7 && wind < 10.9)
            text = 'Gentle breeze'
        else if(wind > 11 && wind < 16.9)
            text = 'Moderate breeze'
        else if(wind > 17 && wind < 21.9)
            text = 'Fresh breeze'
        else if(wind > 22 && wind < 27.9)
            text = 'Strong breeze'
        else if(wind > 28 && wind < 33.9)
            text = 'High wind'
        else if(wind > 34 && wind < 40.9)
            text = 'Gale'
        else if(wind > 41 && wind < 47.9)
            text = 'Strong/severe gale'
        else if(wind > 48 && wind < 55.9)
            text = 'Storm'
        else if(wind > 56 && wind < 63.9)
            text = 'Violent storm'
        else
            text = 'Hurricane force'

        return text;
      }
    },
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