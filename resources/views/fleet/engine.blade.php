@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="engine"></slider-submenu>
        <div class="container">
            @if(strtoupper($fleet->type) == 'S')
            <engine-type-s url="{{ route('api.fleet', $fleet->id) }}"></engine-type-s>
            @endif
            
            <trend-view 
                title="Trend View Engine"
                url="{{ route('api.fleet.engine.trend', $fleet->id) }}"
                :columns="{{ json_encode($fleet->trendOptions('engine')) }}"></trend-view>
        </div>
    </div>
</main>
@endsection
