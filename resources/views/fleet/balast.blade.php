@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu>
        <div class="container">
            <fleet-ballast url="{{ route('api.fleet', $fleet->id) }}"></fleet-ballast>
        </div>
    </div>
</main>
@endsection
