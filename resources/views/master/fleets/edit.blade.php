@extends('layouts.dash')

@section('content')
    <main class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Edit Fleet Master Data </div>

                        <div class="card-body">
                            @if ($errors)
                                @foreach($errors->all() as $message)
                                <small class="form-text text-danger">{{ $message }}</small>
                                @endforeach
                            @endif
                            {!! Form::model($data, ['route' => ['master.fleets.update', $data->id], 'method' => 'PUT']) !!}
                                @include('master.fleets._form')
                                <div class="text-right">
                                    <button type="reset" class="btn btn-secondary">Clear</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
