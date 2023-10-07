@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu', ['fleet' => $fleet])
            {{-- <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu> --}}
        @endif
        <div class="p-3">
            @if(strtoupper($fleet->type) == 'M')
            <engine-type-s url="{{ route('api.fleet', $fleet->id) }}"></engine-type-s>
            @endif
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
