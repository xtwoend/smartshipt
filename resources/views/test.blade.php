@extends('layouts.dash')

@section('content')
<main class="content full">
    <a id="btn-toggle" href="#" class="sidebar-toggler break-point-lg">
        <i class="ri-menu-line ri-xl"></i>
    </a>
    <socket-io
        url="ws://127.0.0.1:9502"
        :fleet="{id: 1}"
        event="navigation_1"
    ></socket-io>
</main>
@endsection