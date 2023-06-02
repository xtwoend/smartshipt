@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="diagnotics"></slider-submenu>
        <div class="container">
            
        </div>
    </div>
</main>
@endsection
