@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="text-bold">Upload Data Main Engine (Form 350)</span>
                        @if(is_null($data))
                        <form action="{{ route('master.form.main-engine.upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row g-2">
                                
                                    <div class="col">
                                        <input name="file" type="file" class="form-control">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary">Upload</button>
                                    </div>
                            </div>
                        </form>
                        @endif
                    </div>
                    <form action="{{ route('master.form.main-engine.process') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        @if($data)
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group mb-3">
                                        <label>Fleet Selected</label>
                                        {!! Form::select("fleet_id", $fleets + [ null => '__NO FLEET__'], null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group mb-3">
                                        <label>Fleet Name</label>
                                        {!! Form::text("fleet_name", $data['fleet_name'], ['class' => 'form-control', 'readonly' => true]) !!}
                                    </div>
                                </div>
                            </div>
                            @foreach($label as $key => $l) 
                            <div class="form-group mb-3">
                                <label>{{ $l }}</label>
                                {!! Form::text($key, $data[$key] ?? null, ['class' => 'form-control']) !!}
                            </div>
                            @endforeach
                        @else
                            <p>No Data / Please Upload First</p>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-primary">SUBMIT</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection