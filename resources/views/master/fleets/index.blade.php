@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Fleet List</span>
                        <div class="float-end">
                            <a href="{{ route('master.fleets.create') }}" class="btn btn-info">Create New Fleet</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Connect Status</th>
                                <th>Last Connection</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->name}}</td>
                                <td>{{$data->connected ? 'connected': 'disconnected'}}</td>
                                <td>{{$data->last_connection}}</td>
                                <td>
                                    <a href="{{ route('master.fleets.show', $data->id) }}">View Data</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
