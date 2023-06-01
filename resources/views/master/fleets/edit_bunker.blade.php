@extends('layouts.dash')

@section('content')
    <main class="content">
        {!! Form::model($data, ['route' => ['master.fleets.updateBunker', $fleet->id], 'method' => 'PUT']) !!}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Edit Fleet Bunker Information Data
                        </div>

                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Fleet Name</label>
                                <input type="text" class="form-control" value="{{ $fleet->name }}" disabled readonly>
                            </div>
                            @include('master.fleets._form_bunker')
                            <div class="text-right floating-btn">
                                <button type="reset" class="btn btn-lg btn-secondary">Clear</button>
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
