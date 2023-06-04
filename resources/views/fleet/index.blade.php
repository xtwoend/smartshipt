@extends('layouts.dash', ['fleet' => $fleet])

@section('content')
<main class="content">
<div class="bg-white">
    <slider-submenu :fleet="{{ json_encode($fleet) }}" active="info"></slider-submenu>
    <map-default :fleet="{{ json_encode($fleet) }}"></map-default>
    <fleet-information url="{{ route('api.fleet', $fleet->id) }}"></fleet-information>
    {{-- <speedometer></speedometer> --}}
    {{-- <charts-speedometer url="{{ route('api.fleet', $fleet->id) }}"></charts-speedometer> --}}
    {{-- <div class="container">
        <div class="row">
            <!-- Navigation information -->
            <div class="col-6">
                <div class="table-title">
                    <h6>Navigation information</h6>
                </div>
                <table class="table table-sm">
                <tbody>
                    <tr>
                        <th scope="row">•</th>
                        <td>Updated at</td>
                        <td class="text-end">{{ $fleet->navigation->updated_at }}</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Coordinate</td>
                        <td class="text-end">{{ $fleet->navigation->lat.' '.$fleet->navigation->lat_dir.', '.$fleet->navigation->lng.' '.$fleet->navigation->lng_dir }}</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Heading</td>
                        <td class="text-end">{{ $fleet->navigation->heading }} °</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Course / COG</td>
                        <td class="text-end">{{ $fleet->navigation->cog }} °</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Speed / SOG</td>
                        <td class="text-end">{{ $fleet->navigation->sog }} knot</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Depth</td>
                        <td class="text-end">{{ $fleet->navigation->depth }} meter</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Wind Speed</td>
                        <td class="text-end">{{ $fleet->navigation->wind_speed }} knot</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Wind Direction</td>
                        <td class="text-end">{{ $fleet->navigation->wind_direction }} °</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Total Travel Distance</td>
                        <td class="text-end">{{ number_format($fleet->navigation->total_distance) }} NM</td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="col-6">
                <div class="row">
                    <!-- Latest voyage -->
                    <div class="col-12">
                        <div class="table-title">
                            <h6>Latest voyage</h6>
                        </div>
                        <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row">•</th>
                                <td>Current Voyage No</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>CII Rating Per Voyage</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>CII Rating Per Year</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>EEOI Score</td>
                                <td class="text-end">0</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <!-- Engine Information -->
                    <div class="col-12">
                        <div class="table-title">
                            <h6>Engine Information</h6>
                        </div>
                        <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row">•</th>
                                <td>RPM Propeller</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Turbo Charger</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Fuel Visco</td>
                                <td class="text-end">9.5 cst</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>JFW Inlet Pressure</td>
                                <td class="text-end">1.05 kg/cm²</td>
                            </tr>
                            <tr>
                                <th scope="row">•</th>
                                <td>Lo Inlet Pressure</td>
                                <td class="text-end">3.35 kg/cm²</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Latest voyage -->
            <div class="col-12">
                <div class="table-title">
                    <h6>Cargo Information</h6>
                </div>
                <table class="table table-sm">
                <tbody>
                    <tr>
                        <th scope="col">STB</th>
                        <td scope="col" colspan="4">154.93 MT</td>
                        <th scope="col">PORT</th>
                        <td scope="col" colspan="4">183.53 MT</td>
                    </tr>
                    <tr>
                        <th scope="col">Cargo</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Level (m)</th>
                        <th scope="col">Weight (MT)</th>
                        <th scope="col">Pump Status</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Level (m)</th>
                        <th scope="col">Weight (MT)</th>
                        <th scope="col" class="text-end">Pump Status</th>
                        <th scope="col" class="text-end">Total (MT)</th>
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
                        <td class="text-end">ON</td>
                        <td class="text-end">2,487.71</td>
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
                        <td class="text-end">ON</td>
                        <td class="text-end">5,106.40</td>
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
                        <td class="text-end">OFF</td>
                        <td class="text-end">2,714.21</td>
                    </tr>
                    <tr>
                        <th colspan="9">Total</th>
                        <td class="text-end">10,308.32</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <!-- Bunker level Information -->
            <div class="col-12">
                <div class="table-title">
                    <h6>Bunker level Information</h6>
                </div>
                <charts-fuel></charts-fuel>
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="col">Service Name</th>
                            <th scope="col" colspan="8" class="text-end">Level Capacity  (%)</th>
                            <th scope="col" class="text-end">Value (KL)</th>
                        </tr>
                        <tr>
                            <td scope="col">HFO Bunker</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">1.97</td>
                        </tr>
                        <tr>
                            <td scope="col">HFO Service</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">6.52</td>
                        </tr>
                        <tr>
                            <td scope="col">HFO Setting</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">6.70</td>
                        </tr>
                        <tr>
                            <td scope="col">FWD HFO</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">3.56</td>
                        </tr>
                        <tr>
                            <td scope="col">LS HFO Bunker</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">0.86</td>
                        </tr>
                        <tr>
                            <td scope="col">LS HFO Service</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">0.20</td>
                        </tr>
                        <tr>
                            <td scope="col">LS HFO Setling</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">1.85</td>
                        </tr>
                        <tr>
                            <td scope="col">MDO Service</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">0.81</td>
                        </tr>
                        <tr>
                            <td scope="col">MDO Storage</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">0.39</td>
                        </tr>
                        <tr>
                            <td scope="col">IGG Fuel</td>
                            <td scope="col" colspan="8" style="vertical-align: middle;">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td scope="col" class="text-end">2.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
</div>
</main>
@endsection
