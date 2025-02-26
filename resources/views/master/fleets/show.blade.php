@extends('layouts.dash')

@section('content')
    <main class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    {{-- tabs --}}

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tab-information" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-information">Fleet</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#pic" class="nav-link" data-bs-toggle="tab" data-bs-target="#pic">PIC</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#cargo" class="nav-link" data-bs-toggle="tab" data-bs-target="#cargo">Cargo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#bunker" class="nav-link" data-bs-toggle="tab" data-bs-target="#bunker">Bunker</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#docs" class="nav-link" data-bs-toggle="tab" data-bs-target="#docs">Docs</a>
                                </li>
                                
                                <!-- Cargo Sounding -->
                                @if (is_array($cargoTanks) && count($cargoTanks) > 1)
                                <li class="nav-item">
                                    <a href="#cargo-sounding" class="nav-link" data-bs-toggle="tab" data-bs-target="#cargo-sounding">Cargo Sounding</a>
                                </li>
                                @endif

                                <!-- Bunker Sounding -->
                                @if (is_array($bunkerTanks) && count($bunkerTanks) > 1)
                                <li class="nav-item">
                                    <a href="#bunker-sounding" class="nav-link" data-bs-toggle="tab" data-bs-target="#bunker-sounding">Bunker Sounding</a>
                                </li>
                                @endif

                                <!-- Tank Correction -->
                                <li class="nav-item">
                                    <a href="#tank-correction" class="nav-link" data-bs-toggle="tab" data-bs-target="#tank-correction">Tank Correction</a>
                                </li>
                                @can('Fleet Threshold Sensor Setting')
                                <li class="nav-item">
                                    <a href="#navigation" class="nav-link" data-bs-toggle="tab" data-bs-target="#navigation">Navigation Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#engine" class="nav-link" data-bs-toggle="tab" data-bs-target="#engine">Main Engine Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#generator" class="nav-link" data-bs-toggle="tab" data-bs-target="#generator">Generator Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#pumps" class="nav-link" data-bs-toggle="tab" data-bs-target="#pumps">Pumps Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#cargo_sensor" class="nav-link" data-bs-toggle="tab" data-bs-target="#cargo_sensor">Cargo Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#fuel" class="nav-link" data-bs-toggle="tab" data-bs-target="#fuel">Fuel Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#ballast" class="nav-link" data-bs-toggle="tab" data-bs-target="#ballast">Ballast Sensor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#draft" class="nav-link" data-bs-toggle="tab" data-bs-target="#draft">Draft Sensor</a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tab-information">
                                    @can('Fleet Manage')
                                    <div class="action-edit">
                                        <a href="{{ route('master.fleets.edit', $data->id) }}" class="btn btn-info">Edit Master Data</a>
                                    </div>
                                    @endcan
                                    {!! Form::model($data, ['route' => ['master.fleets.index'], 'method' => 'PUT']) !!}
                                    @include('master.fleets._form', ['disabled' => 'disabled'])
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane" id="pic">
                                    {!! Form::model($data, ['route' => ['master.fleets.pic', $data->id], 'method' => 'PUT']) !!}
                                    @include('master.fleets._form_pic', ['disabled' => request()->get('mode') !== 'edit' ? 'disabled': '' ])
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane" id="cargo">
                                    @can('Fleet Manage')
                                    <div class="action-edit">
                                        <a href="{{ route('master.fleets.editCargo', $data->id) }}" class="btn btn-info">Edit Cargo Data</a>
                                    </div>
                                    @endcan
                                    {!! Form::model($data->cargo_information, ['route' => ['master.fleets.index'], 'method' => 'PUT']) !!}
                                    @include('master.fleets._form_cargo', ['disabled' => 'disabled'])
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane" id="bunker">
                                    @can('Fleet Manage')
                                    <div class="action-edit">
                                        <a href="{{ route('master.fleets.editBunker', $data->id) }}" class="btn btn-info">Edit Bunker Data</a>
                                    </div>
                                    @endcan
                                    {!! Form::model($data->bunker_information, ['route' => ['master.fleets.index'], 'method' => 'PUT']) !!}
                                    @include('master.fleets._form_bunker', ['disabled' => 'disabled'])
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane" id="docs">
                                    @can('Fleet Manage')
                                    <div class="action-edit">
                                        <a href="{{ route('master.fleets.docs', $data->id) }}" class="btn btn-info">Add Documents</a>
                                    </div>
                                    @endcan

                                    @include('master.fleets.docs', ['fleet' => $data])

                                </div>
                                <!-- Cargo Sounding -->
                                @if (is_array($cargoTanks) && count($cargoTanks) > 1)
                                <div class="tab-pane" id="cargo-sounding">
                                    @include('master.fleets.cargo-sounding', ['fleet' => $data])
                                </div>
                                @endif

                                <!-- Bunker Sounding -->
                                @if (is_array($bunkerTanks) && count($bunkerTanks) > 1)
                                <div class="tab-pane" id="bunker-sounding">
                                    @include('master.fleets.bunker-sounding', ['fleet' => $data])
                                </div>
                                @endif

                                <!-- Tank Correction -->
                                <div class="tab-pane" id="tank-correction">
                                    @include('master.fleets.tank-correction', ['fleet' => $data])
                                </div>
                                <div class="tab-pane" id="navigation">
                                    @include('master.fleets._form_navigation_sensor', [
                                        'lists' => $data->sensors()->where('group', 'navigation')->get(), 
                                        'sensors' => $data->navigationColumns(), 
                                        'fleet' => $data
                                        ])
                                </div>
                                <div class="tab-pane" id="engine">
                                    @include('master.fleets._form_engine_sensor', [
                                        'lists' => $data->sensors()->with('doc')->where('group', 'engine')->get(), 
                                        'sensors' => $data->engineColumns(), 
                                        'fleet' => $data
                                        ])
                                </div>
                                <div class="tab-pane" id="generator">
                                    @include('master.fleets._form_generator_sensor', [
                                        'lists' => $data->sensors()->with('doc')->where('group', 'generator')->get(), 
                                        'sensors' => $data->generatorColumns(), 
                                        'fleet' => $data
                                        ])
                                </div>
                                <div class="tab-pane" id="pumps">
                                    @include('master.fleets._form_pump_sensor', [
                                        'lists' => $data->sensors()->with('doc')->where('group', 'cargo_pump')->get(), 
                                        'sensors' => $data->cargoPumpColumns(), 
                                        'fleet' => $data
                                    ])
                                </div>
                                <div class="tab-pane" id="cargo_sensor">
                                    @include('master.fleets._form_cargo_sensor', [
                                        'lists' => $data->sensors()->where('group', 'cargo')->get(), 
                                        'sensors' => $data->cargoColumns(), 
                                        'fleet' => $data
                                    ])
                                </div>
                                <div class="tab-pane" id="fuel">
                                    @include('master.fleets._form_fuel_sensor', [
                                        'lists' => $data->sensors()->where('group', 'fuel')->get(), 
                                        'sensors' => $data->fuelColumns(), 
                                        'fleet' => $data
                                    ])
                                </div>
                                <div class="tab-pane" id="ballast">
                                    @include('master.fleets._form_ballast_sensor', [
                                        'lists' => $data->sensors()->where('group', 'ballast')->get(), 
                                        'sensors' => $data->ballastColumns(), 
                                        'fleet' => $data
                                    ])
                                </div>
                                <div class="tab-pane" id="draft">
                                    @include('master.fleets._form_draft_sensor', [
                                        'lists' => $data->sensors()->where('group', 'draft')->get(), 
                                        'sensors' => $data->draftColumns(), 
                                        'fleet' => $data
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
