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
                :columns="{{ json_encode([
                    ['data' => 'control_air_inlet', 'text' => 'ME Control Air Inlet Press'],
                    ['data' => 'me_ac_cw_inlet_cooler', 'text' => 'ME AC CW Inlet Cooler Press'],
                    ['data' => 'jcw_inlet', 'text' => 'ME Jacket Cooling Water Press'],
                    ['data' => 'me_lo_inlet', 'text' => 'ME LO Inlet to T/C Press'],
                    ['data' => 'scav_air_receiver', 'text' => 'Scav Air Receiver Press'],
                    ['data' => 'start_air_inlet', 'text' => 'Start Air Inlet Press'],
                    ['data' => 'main_lub_oil', 'text' => 'ME LO Inlet Press'],
                    ['data' => 'me_fo_inlet_engine', 'text' => 'ME FO Inlet Press'],
                    ['data' => 'tachometer_turbocharge', 'text' => 'ME RPM Turbocharge'],
                    ['data' => 'turbo_charger_speed_no_1', 'text' => 'DG No.1 RPM Turbocharge'],
                    ['data' => 'turbo_charger_speed_no_2', 'text' => 'DG No.2 RPM Turbocharge'],
                    ['data' => 'turbo_charger_speed_no_3', 'text' => 'DG No.3 RPM Turbocharge'],
                ]) }}"></trend-view>
        </div>
    </div>
</main>
@endsection
