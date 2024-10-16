@extends('layouts.dash', ['fleet' => $fleet])

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu', ['fleet' => $fleet])
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="table-title">
                    <h6>General Information</h6>
                </div>
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="row">•</th>
                            <td>IMO Number</td>
                            <td class="text-end">{{ $fleet->imo_number }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Ship Owner</td>
                            <td class="text-end">{{ $fleet->owner }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Ship Manager</td>
                            <td class="text-end">{{ $fleet->manager }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Call Sign</td>
                            <td class="text-end">{{ $fleet->call_sign }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Build Year</td>
                            <td class="text-end">{{ $fleet->year }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Class</td>
                            <td class="text-end">{{ $fleet->class }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Builder</td>
                            <td class="text-end">{{ $fleet->builder }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>LoA</td>
                            <td class="text-end">{{ $fleet->length }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>DWT</td>
                            <td class="text-end">{{ $fleet->dwt }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>GT</td>
                            <td class="text-end">{{ $fleet->grt }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>SLA Speed</td>
                            <td class="text-end">{{ $fleet->bunker_information->speed_service }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Engine Marker</td>
                            <td class="text-end">{{ $fleet->engine_maker }}</td>
                        </tr>
                        <tr>
                            <th scope="row">•</th>
                            <td>Engine Type</td>
                            <td class="text-end">{{ $fleet->engine_type }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
