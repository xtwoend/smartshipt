@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="bunker"></slider-submenu>
        <div class="container">
            <fleet-bunker url="{{ route('api.fleet', $fleet->id) }}"></fleet-bunker>
            
            <trend-view 
                    title="Trend View Bunker"
                    url="{{ route('api.fleet.fuel.trend', $fleet->id) }}"
                    :columns="{{ json_encode($fleet->trendOptions('fuel')) }}"></trend-view>
        </div>
    </div>
</main>
@endsection
