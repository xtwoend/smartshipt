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
            {{-- @if(strtoupper($fleet->type) == 'M')
            <fleet-bunker url="{{ route('api.fleet', $fleet->id) }}"></fleet-bunker>
            @endif --}}
            
            @if($mimic = $fleet->mimic()->where('group', 'fuel')->first())
                <fleet-mimic svg-path="/{{ $mimic->path }}" url="{{ route('api.fleet.cargo.current', $fleet->id) }}" group="fuel"></fleet-mimic>
            @endif
            <data-info url="{{ route('api.fleet.cargo.current', $fleet->id) }}" :mapping="{{ json_encode($fleet->trendOptions('fuel')) }}"></data-info>
            <trend-live 
                title="Trend Live Bunker"
                url="{{ route('api.fleet.cargo.current', $fleet->id) }}"
                {{-- url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'cargo']) }}"  --}}
                :fleet="{{ json_encode($fleet) }}"
                :socket-config="{ url: '{{ config('websocket.url') }}', event: 'cargo_{{ $fleet->id }}'}"
                :columns="{{ json_encode($fleet->trendOptions('fuel')) }}">
            </trend-live>
            
            <trend-view 
                    title="Trend View Bunker"
                    url="{{ route('api.fleet.fuel.trend', $fleet->id) }}"
                    :columns="{{ json_encode($fleet->trendOptions('fuel')) }}"></trend-view>
        </div>
    </div>
</main>
@endsection
