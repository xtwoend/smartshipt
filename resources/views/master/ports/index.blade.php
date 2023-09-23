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
                                    <div class="d-flex flex-row">
                                        <a href="{{ route('master.ports.edit', $data->id) }}" class="btn btn-success btn-sm">Edit Data</a>
                                        <form action="{{ route('master.ports.destroy',$data->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sure Want Delete?')">Delete</button>
                                        </form>
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
