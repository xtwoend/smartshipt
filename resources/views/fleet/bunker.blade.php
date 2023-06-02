@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu :fleet="{{ json_encode($fleet) }}" active="bunker"></slider-submenu>
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between my-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Bunker Tank
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Cargo 1</a></li>
                            <li><a class="dropdown-item" href="#">Cargo 2</a></li>
                            <li><a class="dropdown-item" href="#">Cargo 3</a></li>
                        </ul>
                    </div>
                    <small>Last updated 2022-1221 10:53:51 LT</small>
                </div>
            </div>
            <div class="row">
                <!-- Navigation information -->
                <div class="col-12">
                    <div class="table-title">
                        <h6>Bunker level Information</h6>
                    </div>
                    <charts-fuel></charts-fuel>
                </div>
                <div class="col-12">
                    <div class="row justify-content-end">
                        <div class="col-6">
                            <form class="d-flex align-items-center justify-content-end gap-1">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Please select one
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">1 H</a></li>
                                        <li><a class="dropdown-item" href="#">1 D</a></li>
                                        <li><a class="dropdown-item" href="#">1 W</a></li>
                                    </ul>
                                </div>
                                <widget-daterange></widget-daterange>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    1 H
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">1 H</a></li>
                                        <li><a class="dropdown-item" href="#">1 D</a></li>
                                        <li><a class="dropdown-item" href="#">1 W</a></li>
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary">SHOW</button>
                            </form>
                        </div>
                    </div>
                    <charts-graph></charts-graph>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
