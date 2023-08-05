@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="diagnotics"></slider-submenu>
        <div class="p-3">
            
        </div>
    </div>
</main>
@endsection
