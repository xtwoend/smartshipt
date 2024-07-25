@extends('layouts.dash', ['fleet' => $fleet])

@section('content')
<main class="content">
<div class="bg-white">
    @if($fleet->submenu()->count() > 0)
        @include('fleet.menu', ['fleet' => $fleet])
    @else
        @include('fleet._menu', ['fleet' => $fleet])
        {{-- <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu> --}}
    @endif
    <map-default :fleet="{{ json_encode($fleet) }}" style="height: 450px; width:100%;"></map-default>
    {{-- <fleet-information url="{{ route('api.fleet', $fleet->id) }}"></fleet-information> --}}
    <data-info url="{{ route('api.fleet.nav.current', $fleet->id) }}" :mapping="{{ json_encode($fleet->trendOptions('navigation')) }}"></data-info>
    <trend-live 
        title="Trend Live Navigation"
        url="{{ route('api.fleet.nav.current', $fleet->id) }}"
        {{-- url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'cargo']) }}"  --}}
        :fleet="{{ json_encode($fleet) }}"
        :socket-config="{ url: '{{ config('websocket.url') }}', event: 'cargo_{{ $fleet->id }}'}"
        :columns="{{ json_encode($fleet->trendOptions('navigation')) }}">
    </trend-live>

    <trend-view 
            title="Trend View Navigation"
            url="{{ route('api.fleet.nav.trend', $fleet->id) }}"
            :columns="{{ json_encode($fleet->trendOptions('navigation')) }}"></trend-view>
    </div>
    {{-- <div class="p-3">
        <div class="row">
            <div class="col">
                <trend-live 
                    title="Trend Live"
                    url="{{ route('api.fleet.nav.current', $fleet->id) }}"
                    url="{{ route('api.fleet.logger', ['id' => $fleet->id, 'group'=> 'navigation']) }}" 
                    :fleet="{{ json_encode($fleet) }}"
                    :socket-config="{ url: '{{ config('websocket.url') }}', event: 'navigation_{{ $fleet->id }}'}"
                    :columns="{{ json_encode([
                        [
                            'data' => 'sog',
                            'text' => 'Speed',
                        ],
                        [
                            'data' => 'cog',
                            'text' => 'Course',
                        ],
                        [
                            'data' => 'wind_speed',
                            'text' => 'Wind Speed',
                        ],
                        [
                            'data' => 'wind_direction',
                            'text' => 'Wind Direction',
                        ],
                        [
                            'data' => 'depth',
                            'text' => 'Deep Sea',
                        ],
                        [
                            'data' => 'heading',
                            'text' => 'Heading',
                        ],
                        [
                            'data' => 'distance',
                            'text' => 'Travel Distance'
                        ],
                        [
                            'data' => 'total_distance',
                            'text' => 'Total Travel Distance'
                        ],
                        [
                            'data' => 'rot',
                            'text' => 'ROT'
                        ],
                    ]) }}">
                </trend-live>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <trend-view 
                    title="Trend View"
                    url="{{ route('api.fleet.nav.trend', $fleet->id) }}" 
                    :columns="{{ json_encode([
                        [
                            'data' => 'sog',
                            'text' => 'Speed',
                        ],
                        [
                            'data' => 'cog',
                            'text' => 'Course',
                        ],
                        [
                            'data' => 'wind_speed',
                            'text' => 'Wind Speed',
                        ],
                        [
                            'data' => 'wind_direction',
                            'text' => 'Wind Direction',
                        ],
                        [
                            'data' => 'depth',
                            'text' => 'Deep Sea',
                        ],
                        [
                            'data' => 'heading',
                            'text' => 'Heading',
                        ],
                        [
                            'data' => 'distance',
                            'text' => 'Travel Distance'
                        ],
                        [
                            'data' => 'total_distance',
                            'text' => 'Total Travel Distance'
                        ],
                        [
                            'data' => 'rot',
                            'text' => 'ROT'
                        ],
                    ]) }}">
                </trend-view>
            </div>
        </div>
    </div> --}}
</div>
</main>
@endsection
