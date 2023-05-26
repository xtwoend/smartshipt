@extends('layouts.maps')

@section('content')
<main class="content">
    <div class="bridge-area">
        <div class="container-fluid">
            <div class="row mb-3 fixed-top">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <img src="{{asset('img/singapore.png')}}" alt="" />
                                <div class="text-white">PRO</div>
                            </div>
                            <div class="w-100 d-flex align-items-start justify-content-between">
                                <div class="card-title">
                                    <div>MT FALCON VOYAGER</div>
                                    <small class="text-white">IMO 9900001</small>
                                </div>
                                <div class="card-status">
                                    <div class="status-box bg-online"></div>
                                    <div class="text-white">Online</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-flex align-items-center">
                    <div class="dropdown w-100">
                        <button class="btn btn-outline-light dropdown-toggle border-0 border-bottom border-white rounded-0 w-100 justify-content-between px-1 text-yellow" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        PREDICTION AI
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Overview</a></li>
                            <li><a class="dropdown-item" href="#">Performance AI</a></li>
                            <li><a class="dropdown-item" href="#">Prediction AI</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-8 d-flex align-items-center justify-content-end gap-3">
                    <small class="text-muted">Last updated 2022-1221 10:53:51 LT</small>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex content-scrolled">
                <div class="sidebar" id="sidebar">
                <ul class="list-group">
                    <li class="list-group-item">
                        <img src="{{asset('img/icons/alarm.png')}}" alt="" width="18" />
                        Cyl 1 EXh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        <img src="{{asset('img/icons/caution.png')}}" alt="" width="18" />
                        Cyl 1 Compression Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Comp Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Exh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        Avg IMEP vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Max press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Comp Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Exh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        Avg IMEP vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Max press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Comp Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Exh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        Avg IMEP vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Max press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Comp Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Exh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        Avg IMEP vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Max press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Comp Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Exh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        Avg IMEP vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Max press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Comp Press vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Exh Gas Temp vs Load
                    </li>
                    <li class="list-group-item">
                        Avg IMEP vs Load
                    </li>
                    <li class="list-group-item">
                        Avg Max press vs Load
                    </li>
                </ul>
                </div>
                <button onclick="document.getElementsByClassName('sidebar')[0].classList.toggle('collapsed')" class="btn-sidebar">
                    <img src="{{asset('img/icons/chevron-prev.png')}}" alt="" width="12" />
                </button>
                <div class="side-content">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">MAIN ENGINE</li>
                            <li class="breadcrumb-item active" aria-current="page">CYLINDER 1</li>
                        </ol>
                    </nav>
                    <table class="table table-sm table-dark">
                        <tbody>
                            <tr>
                                <td class="align-middle">CYL 1 EXH GAS TEMP VS LOAD</td>
                                <td class="align-middle">379°C</td>
                                <td><div class="bg-danger p-2">61°C</div></td>
                            </tr>
                            <tr>
                                <td class="align-middle">CYL 1 COMPRESSION PRESS VS LOAD</td>
                                <td class="align-middle">86.8 BAR</td>
                                <td><div class="bg-yellow p-2">-13 BAR</div></td>
                            </tr>
                            <tr>
                                <td class="align-middle">CYL IMEP VS LOAD</td>
                                <td class="align-middle">9.99 BAR</td>
                                <td><div class="bg-success p-2">-0.49 BAR</div></td>
                            </tr>
                            <tr>
                                <td class="align-middle">CYL 1 MAX PRESS VS LOAD</td>
                                <td class="align-middle">128.9 BAR</td>
                                <td><div class="bg-success p-2">-9.9 BAR</div></td>
                            </tr>
                            <tr>
                                <td class="align-middle">SCAY AIR PRESS VS T/C SPEED</td>
                                <td class="align-middle">0.102 MPA</td>
                                <td><div class="bg-success p-2">0.004 BAR</div></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-5 mb-3">ME ESC ESTIMATED ENGINE LOAD</div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
