@extends('layouts.maps')

@section('content')
<main class="content">
    <div class="bridge-area">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
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
                        Performance AI
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Overview</a></li>
                            <li><a class="dropdown-item" href="#">Performance AI</a></li>
                            <li><a class="dropdown-item" href="#">Prediction AI</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-3 performanceDate">
                    <widget-daterange></widget-daterange>
                </div>
                <div class="col-5 d-flex align-items-center justify-content-end gap-3">
                    <small class="text-muted">Last updated 2022-1221 10:53:51 LT</small>
                    <button type="button" class="btn btn-info">Analysis Details</button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex">
                <div class="sidebar sticky-top" id="sidebar">
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
                </ul>
                </div>
                <button onclick="document.getElementsByClassName('sidebar')[0].classList.toggle('collapsed')" class="btn-sidebar">
                    <img src="{{asset('img/icons/chevron-prev.png')}}" alt="" width="12" />
                </button>
                <div class="side-content">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                    <charts-spline></charts-spline>
                    <div class="mt-5 mb-3">ME ESC ESTIMATED ENGINE LOAD</div>
                    <charts-spline></charts-spline>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
