@extends('layouts.dash')

@section('content')
    <main class="content">
        {!! Form::model($row, ['route' => ['master.user.roles.update', $row->id], 'method' => 'POST']) !!}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Update User Permission
                        </div>

                        <div class="card-body">
                            @if ($errors)
                                @foreach($errors->all() as $message)
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @endforeach
                            @endif

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly', 'disabled']) !!}
                                        @if ($errors->has('name'))
                                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        {!! Form::email('email', null, ['class' => 'form-control', 'readonly', 'disabled']) !!}
                                        @if ($errors->has('email'))
                                            <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    {{-- <user-permission url="{{ route('master.user.roles.get', $row->id) }}"></user-permission> --}}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </main>
@endsection
