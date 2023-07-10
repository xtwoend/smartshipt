@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="cargo"></slider-submenu>

        {{-- <div class="container"> --}}
            <fleet-cargo url="{{ route('api.fleet', $fleet->id) }}"></fleet-cargo>

            <trend-view 
                    title="Trend View Cargo"
                    url="{{ route('api.fleet.cargo.trend', $fleet->id) }}"
                    :columns="{{ json_encode($fleet->trendOptions('cargo')) }}"></trend-view>
        {{-- </div> --}}
    </div>
</main>
@endsection
