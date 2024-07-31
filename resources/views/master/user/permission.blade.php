@extends('layouts.dash')

@section('content')
    <main class="content">
        
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
                                        {!! Form::text('name', $row->name, ['class' => 'form-control', 'readonly', 'disabled']) !!}
                                        @if ($errors->has('name'))
                                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        {!! Form::email('email', $row->email, ['class' => 'form-control', 'readonly', 'disabled']) !!}
                                        @if ($errors->has('email'))
                                            <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <user-permission url="{{ route('master.user.permission.get', $row->id) }}"></user-permission>
                                </div>
                                <div class="col-6">
                                    <user-fleets url="{{ route('master.user.fleets.get', $row->id) }}"></user-fleets>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
@endsection
