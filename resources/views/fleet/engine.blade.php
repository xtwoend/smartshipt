@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="engine"></slider-submenu>
        <div class="container">
            @if(strtoupper($fleet->type) == 'S')
            <engine-type-s url="{{ route('api.fleet', $fleet->id) }}"></engine-type-s>
            @endif
        </div>
    </div>
</main>
@endsection
