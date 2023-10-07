@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu')
            {{-- <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu> --}}
        @endif
        <div class="p-3">
            {{--  --}}
            <mimic-svg group="cargo_pump" svg-path="/svg/pumps.svg" url="{{ route('api.fleet', $fleet->id) }}"></mimic-svg> 
        </div>
    </div>
</main>
@endsection
