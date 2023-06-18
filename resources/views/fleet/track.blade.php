@extends('layouts.dash')

@section('content')
<main class="content full">
    <a id="btn-toggle" href="#" class="sidebar-toggler break-point-lg">
        <i class="ri-menu-line ri-xl"></i>
    </a>
    <map-default :fleet="{{ json_encode($fleet) }}" style="height: calc(100vh - 120px); width:100%;" sidebar></map-default>
</main>
@endsection