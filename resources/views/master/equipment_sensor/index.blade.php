@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Equipment Sensor Manage</span>
                        
                        <div class="float-end">
                            <a href="{{ route('master.equipment.show', $equipment->fleet_id) }}" class="btn btn-success" style="margin-right:10px;">Back</a>
                            @can('Fleet Manage')
                            <a href="{{ route('master.equipment.sensor.add', $equipment->id) }}" class="btn btn-info">Add Sensor On Equipment</a>
                            @endcan
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>SENSOR NAME</th>
                                <th>NORMAL VALUE</th>
                                <th>HIGH VALUE</th>
                                <th>SENSOR TRIGGER</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->sensor->name}}</td>
                                <td>{{$data->sensor->normal}}</td>
                                <td>{{$data->sensor->danger}}</td>
                                <td>{{$data->sensor_trigger}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Action</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('master.equipment.sensor.edit', $data->id) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-red" href="#" onclick="event.preventDefault(); let c = confirm('Are you sure you want to delete this item?'); c ? document.getElementById('remove-{{ $data->id }}').submit() : null; ">Remove</a>
                                            <form id="remove-{{ $data->id }}" action="{{ route('master.equipment.sensor.destroy', $data->id) }}" method="POST" style="display: none;">
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
