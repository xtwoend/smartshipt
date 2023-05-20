@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        <slider-submenu></slider-submenu>
        <map-default></map-default>
        <div class="container">
            <div class="row">
                <!-- Navigation information -->
                <div class="col-12">
                    <div class="table-title">
                        <h6>PERFORMANCE INFROMATION</h6>
                    </div>
                    <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="row" colspan="3">Voyage No : 008/V1133/04/2023</th>
                            <th class="text-center" colspan="2">Status</th>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <th scope="row">Data </th>
                            <th>Avg.  </th>
                            <th>Fixture Note</th>
                            <th class="text-center">Status</th>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Speed / SOG</td>
                            <td>0.10 knot</td>
                            <td>14 knot</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success">Normal</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Loading rate</td>
                            <td>1200 KL/hour</td>
                            <td>1500 KL/hour</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger">Tidak Normal</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Pumping rate</td>
                            <td>3000 KL/hour</td>
                            <td>400 KL/hour</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger">Tidak Normal</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Transport Loss</td>
                            <td>-27.00 meter</td>
                            <td>-27.00 meter</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success">Normal</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Wind Speed</td>
                            <td>0.70 knot</td>
                            <td>0.70 knot</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success">Normal</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Total Travel Distance</td>
                            <td>89,039.42 NM</td>
                            <td>89,039.42 NM</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success">Normal</button>
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
