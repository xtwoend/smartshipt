@extends('layouts.dash')

@section('content')
    <main class="content">
        {!! Form::model($data, ['route' => ['master.fleets.update', $data->id], 'method' => 'PUT']) !!}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Edit Fleet Master Data
                            <div class="text-right floating-btn">
                                <button type="reset" class="btn btn-lg btn-secondary">Clear</button>
                                <button type="submit" class="btn btn-lg btn-success ml-2">Save</button>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($errors)
                                @foreach($errors->all() as $message)
                                <small class="form-text text-danger">{{ $message }}</small>
                                @endforeach
                            @endif

                            @include('master.fleets._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </main>
@endsection
