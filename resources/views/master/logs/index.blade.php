@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>User Activity Log</span>
                        <div class="float-end">
                            {{-- <a href="{{ route('master.users.create') }}" class="btn btn-info">Create New User</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Activity</th>
                                <th>Data Change</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $data)
                            <tr class="">
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->causer?->name}}</td>
                                <td>{{ $data->description }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $lists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
