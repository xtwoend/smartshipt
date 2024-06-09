@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Equipment Manage</span>
                        
                        
                        <div class="float-end">
                            <a href="{{ route('master.fleets.index') }}" class="btn btn-success" style="margin-right:10px;">Back</a>
                            @can('Fleet Manage')
                            <a href="{{ route('master.equipment.add', $fleet->id) }}" class="btn btn-info">Add Equipment</a>
                            @endcan
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>NAME</th>
                                <th>GROUP</th>
                                <th>LAST MAINTENANCE</th>
                                <th>SCHEDULE MAINTENANCE</th>
                                <th>NEXT PREDITIVE MAINTENANCE</th>
                                <th>LIFETIME IN HOURS</th>
                                <th>SCORE</th>
                                <th>CONDITION</th>
                                <th>TOTAL SENSOR</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->name}}</td>
                                <td>{{ $groups[$data->group] ?? 'Unknown' }}</td>
                                <td>{{$data->last_maintenance}}</td>
                                <td>{{$data->schedule_maintenance}}</td>
                                <td>{{$data->next_maintenance}}</td>
                                <td class="text-end">{{$data->lifetime_hours}}</td>
                                <td class="text-end">{{$data->score}}</td>
                                <td>{{$data->condition}}</td>
                                <td class="text-end">{{$data->sensors->count()}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Action</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('master.equipment.edit', $data->id) }}">Edit</a>
                                            <a class="dropdown-item" href="{{ route('master.equipment.sensor.show', $data->id) }}">Manage Sensors</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-red" href="#" onclick="event.preventDefault(); let c = confirm('Are you sure you want to delete this item?'); c ? document.getElementById('remove-{{ $data->id }}').submit() : null; ">Remove</a>
                                            <form id="remove-{{ $data->id }}" action="{{ route('master.equipment.destroy', $data->id) }}" method="POST" style="display: none;">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $list->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
