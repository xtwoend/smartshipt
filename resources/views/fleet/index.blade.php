@extends('layouts.dash', ['fleet' => $fleet])

@section('content')
<main class="content">
<div class="bg-white">
    <slider-submenu :fleet="{{ json_encode($fleet) }}" active="info"></slider-submenu>
    <map-default :fleet="{{ json_encode($fleet) }}" style="height: 450px; width:100%;"></map-default>
    <fleet-information url="{{ route('api.fleet', $fleet->id) }}"></fleet-information>
    <div class="container">
        <div class="row">
            <div class="col">
                <trend-live 
                    title="Trend Live"
                    url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'navigation']) }}" 
                    :fleet="{{ json_encode($fleet) }}"
                    :socket-config="{ url: '{{ config('websocket.url') }}', event: 'navigation_{{ $fleet->id }}'}"
                    :columns="{{ json_encode([
                        [
                            'data' => 'sog',
                            'text' => 'Speed',
                        ],
                        [
                            'data' => 'wind_speed',
                            'text' => 'Wind Speed',
                        ],
                        [
                            'data' => 'depth',
                            'text' => 'Deep Sea',
                        ]
                    ]) }}">
                </trend-live>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <trend-view 
                    title="Trend View"
                    url="{{ route('api.fleet.nav.trend', $fleet->id) }}" 
                    :columns="{{ json_encode([
                        [
                            'data' => 'sog',
                            'text' => 'Speed',
                        ],
                        [
                            'data' => 'wind_speed',
                            'text' => 'Wind Speed',
                        ],
                        [
                            'data' => 'depth',
                            'text' => 'Deep Sea',
                        ]
                    ]) }}">
                </trend-view>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
