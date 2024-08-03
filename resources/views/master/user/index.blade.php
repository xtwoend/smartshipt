@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>User List</span>
                        <div class="float-end">
                            <a href="{{ route('master.user.create') }}" class="btn btn-info">Create New User</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $data)
                            <tr class="">
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="">
                                            <a class="dropdown-item" href="{{route('master.user.edit', $data->id)}}"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="dropdown-item" href="{{route('master.user.permission', $data->id)}}" data-action="permission-toggle" data-target="#permission"><i class="fa fa-unlock-alt"></i> Permissions</a>
                                            <a class="dropdown-item" href="{{route('master.activity.logs', ['user_id' => $data->id])}}"><i class="fa fa-eye"></i> Activity Log</a>
                                            <form class="" action="{{route('master.user.destroy', $data->id)}}" method="post" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete" />
                                                <button type="submit" class="dropdown-item">Remove</button>
                                            </form>
                                        </ul>
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
