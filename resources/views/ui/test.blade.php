@extends('layouts.dash')

@section('content')
<div class="bg-white">
    <slider-submenu></slider-submenu>
    <map-default></map-default>
    <charts-speedometer></charts-speedometer>
    <div class="container">
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
                        <td class="text-end">2023-01-17 10:49:06</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Coordinate</td>
                        <td class="text-end">-5.534742 S, 104.59628 E</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Heading</td>
                        <td class="text-end">69.00 °</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Course / COG</td>
                        <td class="text-end">69.00 °</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Speed / SOG</td>
                        <td class="text-end">0.10 knot</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Depth</td>
                        <td class="text-end">-27.00 meter</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Wind Speed</td>
                        <td class="text-end">0.70 knot</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Wind Direction</td>
                        <td class="text-end">312.50 °</td>
                    </tr>
                    <tr>
                        <th scope="row">•</th>
                        <td>Total Travel Distance</td>
                        <td class="text-end">89,039.42 NM</td>
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
    </div>
</div>
@endsection
