@extends('layouts.maps')

@section('content')
<main class="content">
    <div class="bridge-area">
        <div class="container-fluid">
            <div class="row mb-3">
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
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <td colspan="3">Asset Details</td>
                                <td>Performance</td>
                                <td class="bg-danger">1 Alarm</td>
                                <td class="bg-yellow">1 Warning</td>
                                <td class="text-center">Prediction</td>
                                <td class="bg-danger">1 Alarm</td>
                                <td class="bg-yellow text-dark">1 Warning</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="3">
                                    <h6 class="text-yellow">Bridge</h6>
                                    <div>MITSUI-MAN B&W 6G6OME-C5L5</div>
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>RUNNING 1000 HRS</small>
                                    </div>
                                </td>
                                <td rowspan="3"><img src="{{asset('img/icons/ship2.png')}}" alt="" /></td>
                                <td>
                                    <div><img src="{{asset('img/icons/maintenance.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                                <td>PARAMETER</td>
                                <td>VALUE</td>
                                <td>DEVIATION</td>
                                <td>COMPONENT</td>
                                <td>HEALTH</td>
                                <td>RUL</td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img src="{{asset('img/icons/clock.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                                <td>CYL EXH GAS TEMP VS LOAD</td>
                                <td>379°C</td>
                                <td class="bg-danger">61°C</td>
                                <td>CYL EXH GAS TEMP VS LOAD</td>
                                <td class="bg-yellow">61%</td>
                                <td class="bg-danger">348h</td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img src="{{asset('img/icons/settings.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                                <td>CYL EXH GAS TEMP VS LOAD</td>
                                <td>86.8 BAR</td>
                                <td class="bg-yellow">-13 BAR</td>
                                <td>CYL EXH GAS TEMP VS LOAD</td>
                                <td class="bg-yellow">61%</td>
                                <td class="bg-danger">348h</td>
                            </tr>
                            <tr>
                                <td rowspan="3">
                                    <h6 class="text-yellow">Bridge</h6>
                                    <div>MITSUI-MAN B&W 6G6OME-C5L5</div>
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>RUNNING 1000 HRS</small>
                                    </div>
                                </td>
                                <td rowspan="3"><img src="{{asset('img/icons/ship2.png')}}" alt="" /></td>
                                <td>
                                    <div><img src="{{asset('img/icons/maintenance.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                                <td colspan="3" rowspan="3" class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>WITHIN LIMITS</small>
                                    </div>
                                </td>
                                <td colspan="3" rowspan="3" class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>WITHIN LIMITS</small>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img src="{{asset('img/icons/clock.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img src="{{asset('img/icons/settings.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="3">
                                    <h6 class="text-yellow">Bridge</h6>
                                    <div>MITSUI-MAN B&W 6G6OME-C5L5</div>
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>RUNNING 1000 HRS</small>
                                    </div>
                                </td>
                                <td rowspan="3"><img src="{{asset('img/icons/ship2.png')}}" alt="" /></td>
                                <td>
                                    <div><img src="{{asset('img/icons/maintenance.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                                <td colspan="3" rowspan="3" class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>WITHIN LIMITS</small>
                                    </div>
                                </td>
                                <td colspan="3" rowspan="3" class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <div class="card-status">
                                            <div class="status-box bg-online"></div>
                                        </div>
                                        <small>WITHIN LIMITS</small>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img src="{{asset('img/icons/clock.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div><img src="{{asset('img/icons/settings.png')}}" alt="" /> 2018-10-08</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
