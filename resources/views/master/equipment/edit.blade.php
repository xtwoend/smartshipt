@extends('layouts.dash')

@section('content')
    <main class="content">
        {!! Form::model($data, ['route' => ['master.equipment.update', $data->id], 'method' => 'PUT']) !!}
        @method("put")
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Add Fleet Equipment
                        </div>

                        <div class="card-body">
                            @if ($errors)
                                @foreach($errors->all() as $message)
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @endforeach
                            @endif

                            @include('master.equipment._form')
                            <div class="float-end">
                                <a href="{{ route('master.equipment.show', $fleet->id) }}" class="btn btn-lg btn-secondary">Cancel</a>
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
