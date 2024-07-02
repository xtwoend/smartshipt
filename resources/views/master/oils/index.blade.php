@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="text-bold">Oil analysis tools</span>
                        
                        <form action="{{ route('master.oils.file-upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row g-2">
                                
                                    <div class="col">
                                        <input name="file" type="file" class="form-control">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-icon">
                                            <img src="/img/icons/skipped.svg" height="20">
                                        </button>
                                    </div>
                            </div>
                        </form>

                            <form action="{{ route('master.oils.clear-data') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-auto">
                                    <button class="btn btn-danger">Clear Processing Data</button>
                                </div>
                            </form>
                    
                    </div>
                    <form action="{{ route('master.oils.store') }}" method="POST">
                        {{ csrf_field() }} 
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="source" class="form-label">
                                    Source
                                </label>
                            </div>
                            <div class="col-1"></div>
                            <div class="col">
                                <label for="source" class="form-label">
                                    Target
                                </label>
                            </div>
                        </div>
                        @foreach($oilVessels as $vessel)
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" value="{{ $vessel }}" class="form-control" readonly>
                            </div>
                            <div class="col-1">
                                <div class="w-100 sparator d-flex align-items-end h-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="64px" height="64px" viewBox="0 0 20 20">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                        <g id="SVGRepo_iconCarrier"><polygon points="16.172 9 10.101 2.929 11.515 1.515 20 10 19.293 10.707 11.515 18.485 10.101 17.071 16.172 11 0 11 0 9"/></g>
                                    </svg>
                                </div>
                            </div>
                            <div class="col">
                                {!! Form::select("fleets[$vessel]", $fleets + [ null => '__NO FLEET__'], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        @endforeach
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