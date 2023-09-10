@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @include('fleet.menu', ['fleet' => $fleet])
        <div class="p-3">
            <mimic-svg svg-path="/svg/kakap/engine.svg" url="{{ route('api.fleet', $fleet->id) }}"></mimic-svg> 
            <trend-live 
                title="Trend Live Engine"
                url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'engine']) }}" 
                :fleet="{{ json_encode($fleet) }}"
                :socket-config="{ url: '{{ config('websocket.url') }}', event: 'engine_{{ $fleet->id }}'}"
                :columns="{{ json_encode($fleet->trendOptions('engine')) }}">
            </trend-live>
            <trend-view 
                title="Trend View Engine"
                url="{{ route('api.fleet.engine.trend', $fleet->id) }}"
                :columns="{{ json_encode($fleet->trendOptions('engine')) }}"></trend-view>
        </div>
    </div>
</main>
@endsection
