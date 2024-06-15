@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu', ['fleet' => $fleet])
        @endif
        <div class="p-3">
            <div class="table-title">
                <h6>Equipments Schedule Maintenance & Equipment Scoring</h6>
            </div>
            <table class="table table-sm equipment mt-3">
                <thead>
                    <tr>
                        <th></th>
                        <th>Equipment</th>
                        <th>Group</th>
                        <th>Last Schedule</th>
                        <th>Next Schedule</th>
                        <th>Repair Time Target (Hours)</th>
                        <th>Degradation Factor</th>
                        <th>Predicted Time to Repair (Hours)</th>
                        <th>Perfomance</th>
                        <th>Status</th>
                        <th>Next Maintainance Prediction</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipments as $equipment)
                    <tr>
                        <td></td>
                        <td>{{ $equipment->name }}</td>
                        <td>{{ $equipment->group }}</td>
                        <td>{{ $equipment->last_maintenance }}</td>
                        <td>{{ $equipment->schedule_maintenance }}</td>
                        <td>{{ $equipment->lifetime_hours }}</td>
                        <td>{{ $equipment->degradation_factor }}</td>
                        <td>{{ $equipment->predicted_time_repair }}</td>
                        <td>{{ $equipment->score }}</td>
                        <td>{{ $equipment->status }}</td>
                        <td>{{ $equipment->next_maintenance }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
