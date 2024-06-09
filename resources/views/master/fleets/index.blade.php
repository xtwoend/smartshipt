@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Fleet List</span>
                        @can('Fleet Manage')
                        <div class="float-end">
                            <a href="{{ route('master.fleets.create') }}" class="btn btn-info">Create New Fleet</a>
                        </div>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>NAME</th>
                                <th>IMO NUMBER</th>
                                <th>FLEET MANAGER</th>
                                <th>EMAIL</th>
                                <th>BUILD YEAR</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->name}}</td>
                                <td>{{$data->imo_number}}</td>
                                <td>{{$data->ship_manager}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->year}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Action</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('master.fleets.show', $data->id) }}">View Data</a>
                                            <a class="dropdown-item" href="{{ route('master.equipment.show', $data->id) }}">Manage Equipment</a>
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
