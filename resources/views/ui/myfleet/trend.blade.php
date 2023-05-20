@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu></slider-submenu>
        <div class="container">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between my-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Cargo Tank
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
                        <h6>Cargo Information</h6>
                    </div>
                    <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th>STB</th>
                            <td colspan="4">154.93 MT</td>
                            <td>PORT</td>
                            <td colspan="4">183.53 MT</td>
                        </tr>
                        <tr>
                            <th scope="row">Cargo</th>
                            <th scope="row">Grade </th>
                            <th>Level (m)</th>
                            <th>Weight (MT)</th>
                            <th>Pump Status</th>
                            <th>Grade</th>
                            <th>Level (m)</th>
                            <th>Weight (MT)</th>
                            <th>Pump Status</th>
                            <th>Total (MT)</th>
                        </tr>
                        <tr>
                            <td>Cargo Tank 1</td>
                            <td>PROPANE</td>
                            <td>5.56</td>
                            <td>46.99</td>
                            <td>OFF</td>
                            <td>PROPANE</td>
                            <td>5.92</td>
                            <td>58.03</td>
                            <td>ON</td>
                            <td>2,487.71</td>
                        </tr>
                        <tr>
                            <td>Cargo Tank 2</td>
                            <td>BUTANE</td>
                            <td>6.27</td>
                            <td>61.61</td>
                            <td>OFF</td>
                            <td>BUTANE</td>
                            <td>5.92</td>
                            <td>58.03</td>
                            <td>ON</td>
                            <td>5,106.40</td>
                        </tr>
                        <tr>
                            <td>Cargo Tank 3</td>
                            <td>PROPANE</td>
                            <td>16,813.19</td>
                            <td>44.73</td>
                            <td>OFF</td>
                            <td>PROPANE</td>
                            <td>56.50</td>
                            <td>52.26</td>
                            <td>OFF</td>
                            <td>2,714.21</td>
                        </tr>
                        <tr>
                            <th colspan="9">Total</th>
                            <td>PROPANE</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="row justify-content-end">
                        <div class="col-6">
                            <form class="d-flex align-items-center justify-content-end gap-1">
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
