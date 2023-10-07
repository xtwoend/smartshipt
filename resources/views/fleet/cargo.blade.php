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
        
        @if($fleet->id == 6)
            @include('fleets.walio.cargo', ['fleet' => $fleet])
        @else
        <div class="p-3">
            @if(strtoupper($fleet->type) == 'M')
            <fleet-cargo url="{{ route('api.fleet', $fleet->id) }}"></fleet-cargo>
            @endif
            <trend-live 
                title="Trend Live Cargo"
                url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'cargo']) }}" 
                :fleet="{{ json_encode($fleet) }}"
                :socket-config="{ url: '{{ config('websocket.url') }}', event: 'cargo_{{ $fleet->id }}'}"
                :columns="{{ json_encode($fleet->trendOptions('cargo')) }}">
            </trend-live>

            <trend-view 
                    title="Trend View Cargo"
                    url="{{ route('api.fleet.cargo.trend', $fleet->id) }}"
                    :columns="{{ json_encode($fleet->trendOptions('cargo')) }}"></trend-view>
        </div>
        @endif
    </div>
</main>
@endsection
