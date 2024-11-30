@extends('layouts.dash')

@section('content')
<main class="content full">
    <div id="map" style="height: 100%;"></div>
</main>
@endsection

@push('js_after')

<script>
    window.addEventListener('load', () => {

        // Create the Mapbox map instance
        mapboxgl.accessToken = 'pk.eyJ1Ijoia3JvbmljayIsImEiOiJjaWxyZGZwcHQwOHRidWxrbnd0OTB0cDBzIn0.u2R3NY5PnevWH3cHRk6TWQ';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/outdoors-v11',
            center: [-85.5, 40],
            zoom: 3,
            // projection: 'mercator'
        });

        const account = new mapsgl.Account('wEQlTfMuZVuZGadk0GElq', 'dOlGZOeangNxL5ppi8RczOUZcIUXYqWoCVR0WLsw');
        const controller = new mapsgl.MapboxMapController(map, {
            account: account,
            animation: {
                repeat: true
            },
            units: {
                temperature: 'C',
                speed: 'km/h',
                pressure: 'hPa',
                distance: 'mi',
                height: 'm',
                precipitation: 'm',
                snowfall: 'm',
                direction: '°',
                time: 'hr',
                ratio: '%'
            }
        });

        controller.on('load', () => {
            console.log(map)
            console.log(controller)
            // Do stuff, like add weather layers
            controller.addWeatherLayer('radar');
            controller.addWeatherLayer('wind-particles', {
                paint: {
                    opacity: 0.5
                }
            });
        });
    });
</script>
@endpush