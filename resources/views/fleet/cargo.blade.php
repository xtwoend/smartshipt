@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="cargo"></slider-submenu>

        <div class="p-3">
            <fleet-cargo url="{{ route('api.fleet', $fleet->id) }}"></fleet-cargo>

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
    </div>
</main>
@endsection
