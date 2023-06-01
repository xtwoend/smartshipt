@extends('layouts.dash')

@section('content')
    <main class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <span>Fleet Master Data</span>
                            <div class="float-end">
                                <a href="{{ route('master.fleets.edit', $data->id) }}" class="btn btn-info">Edit Master Data</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {!! Form::model($data, ['route' => ['master.fleets.index'], 'method' => 'PUT']) !!}
                            @include('master.fleets._form', ['disabled' => 'disabled'])
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <span>Edit Fleet Cargo Information Data</span>
                            <div class="float-end">
                                <a href="{{ route('master.fleets.editCargo', $data->id) }}" class="btn btn-info">Edit Master Data</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {!! Form::model($data->cargo_information, ['route' => ['master.fleets.index'], 'method' => 'PUT']) !!}
                            @include('master.fleets._form_cargo', ['disabled' => 'disabled'])
                            {!! Form::close() !!}

                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <span>Edit Fleet Bunker Information Data</span>
                            <div class="float-end">
                                <a href="{{ route('master.fleets.editBunker', $data->id) }}" class="btn btn-info">Edit Master Data</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {!! Form::model($data->bunker_information, ['route' => ['master.fleets.index'], 'method' => 'PUT']) !!}
                            @include('master.fleets._form_bunker', ['disabled' => 'disabled'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
