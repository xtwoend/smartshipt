@extends('layouts.dash')

@section('content')
    <main class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Fleet List</div>

                        <div class="card-body">
                            {!! Form::model($row, ['route' => ['admin.user.update', $row->id], 'method' => 'PUT']) !!}
                                @include('master.fleets._form')
                            {!! Form::close() !!}
                            <div class="text-right">
                                <button type="reset" class="md-btn md-flat mb-2 w-xs text-warning">Clear</button>
                                <button type="submit" class="md-btn md-raised mb-2 w-xs green">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
