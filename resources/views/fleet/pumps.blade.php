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
            @if($mimic = $fleet->mimic()->where('group', 'engine')->first())
                @if($fleet->id <= 4)
                    <fleet-mimic svg-path="/{{ $mimic->path }}" url="{{ route('api.fleet.pumps.current', $fleet->id) }}" group="cargo_pump"></fleet-mimic>
                @else
                    <fleet-mimic svg-path="/{{ $mimic->path }}" url="{{ route('api.fleet.pumps.current', $fleet->id) }}" group="cargo_pump"></fleet-mimic>
                @endif
            @endif

            @if($fleet->id <= 4)
            <data-info url="{{ route('api.fleet.pumps.current', $fleet->id) }}" :mapping="{{ json_encode($fleet->trendOptions('cargo_pump')) }}"></data-info>
            <trend-live 
                title="Trend Live Cargo Pumps"
                url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'cargo_pump']) }}" 
                :fleet="{{ json_encode($fleet) }}"
                :socket-config="{ url: '{{ config('websocket.url') }}', event: 'cargo_{{ $fleet->id }}'}"
                :columns="{{ json_encode($fleet->trendOptions('cargo_pump')) }}">
            </trend-live>
            <trend-view 
                title="Trend View Cargo Pumps"
                url="{{ route('api.fleet.pumps.trend', $fleet->id) }}"
                :columns="{{ json_encode($fleet->trendOptions('cargo_pump')) }}"></trend-view>
            @else
            <data-info url="{{ route('api.fleet.cargo.current', $fleet->id) }}" :mapping="{{ json_encode($fleet->trendOptions('cargo_pump')) }}"></data-info>
            <trend-live 
                title="Trend Live Cargo Pumps"
                url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'cargo']) }}" 
                :fleet="{{ json_encode($fleet) }}"
                :socket-config="{ url: '{{ config('websocket.url') }}', event: 'cargo_{{ $fleet->id }}'}"
                :columns="{{ json_encode($fleet->trendOptions('cargo_pump')) }}">
            </trend-live>
            <trend-view 
                title="Trend View Cargo Pumps"
                url="{{ route('api.fleet.cargo.trend', $fleet->id) }}"
                :columns="{{ json_encode($fleet->trendOptions('cargo_pump')) }}"></trend-view>
            @endif
        </div>
    </div>
</main>
@endsection
