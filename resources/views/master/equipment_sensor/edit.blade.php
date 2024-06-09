@extends('layouts.dash')

@section('content')
    <main class="content">
        {!! Form::model($sensor, ['route' => ['master.equipment.sensor.update', $sensor->id], 'method' => 'PUT']) !!}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Edit Sensor Equipment
                        </div>
                        <div class="card-body">
                            @if ($errors)
                                @foreach($errors->all() as $message)
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @endforeach
                            @endif

                            @include('master.equipment_sensor._form', ['equipment' => $sensor->equipment])
                            <div class="float-end">
                                <a href="{{ route('master.equipment.sensor.show', $sensor->equipment_id) }}" class="btn btn-lg btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-lg btn-success ml-2">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </main>
@endsection
