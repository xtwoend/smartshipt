@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Port List</span>
                        <div class="float-end">
                            <a href="{{ route('master.ports.create') }}" class="btn btn-info">Add New Port</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->name}}</td>
                                <td>{{$data->location}}</td>
                                <td>{{$data->lat}}</td>
                                <td>{{$data->lng}}</td>
                                <td>
                                    <a href="{{ route('master.ports.edit', $data->id) }}">Edit Data</a>
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
