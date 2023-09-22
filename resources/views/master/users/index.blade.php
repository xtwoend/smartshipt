@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Users List</span>
                        <div class="float-end">
                            <a href="{{ route('master.users.create') }}" class="btn btn-info">Create New User</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->roles}}</td>
                                <td>
                                    <a href="{{ route('master.users.show', $data->id) }}">View Data</a>
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
