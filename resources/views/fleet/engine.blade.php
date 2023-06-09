@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="engine"></slider-submenu>
        <div class="container">
            <fleet-engine url="{{ route('api.fleet', $fleet->id) }}"></fleet-engine>

        </div>
    </div>
</main>
@endsection
