@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu>
        <div class="p-3">
            <fleet-ballast url="{{ route('api.fleet', $fleet->id) }}"></fleet-ballast>
            <trend-live 
                title="Trend Live Bunker"
                url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'cargo']) }}" 
                :fleet="{{ json_encode($fleet) }}"
                :socket-config="{ url: '{{ config('websocket.url') }}', event: 'cargo_{{ $fleet->id }}'}"
                :columns="{{ json_encode($fleet->trendOptions('ballast')) }}">
            </trend-live>
            <trend-view 
                    title="Trend View Ballast"
                    url="{{ route('api.fleet.ballast.trend', $fleet->id) }}"
                    :columns="{{ json_encode($fleet->trendOptions('ballast')) }}"></trend-view>
        </div>
    </div>
</main>
@endsection
