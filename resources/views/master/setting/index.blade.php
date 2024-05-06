@extends('layouts.dash')

@section('content')
<main class="content full">
    <a id="btn-toggle" href="#" class="sidebar-toggler break-point-lg">
        <i class="ri-menu-line ri-xl"></i>
    </a>
    
    <div class="card">
        <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">
                <div class="card-body">
                    <h4 class="subheader">Settings</h4>
                    <div class="list-group list-group-transparent">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">SMTP Settings</a>
                    </div>
                    {{-- <h4 class="subheader mt-4">Experience</h4>
                    <div class="list-group list-group-transparent">
                        <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
                    </div> --}}
                </div>
            </div>
            <div class="col d-flex flex-column">
                {{ Form::open(['route' => ['master.settings.store'], 'method' => 'POST', 'id' => 'setting']) }}
                <div class="card-body">
                    <h2 class="mb-4">SMTP Settings</h2>

                    <h3 class="card-title mt-4">Server Setting</h3>
                    <div class="row g-3 mb-2">
                        <div class="col-md">
                            <div class="form-label">HOST</div>
                            {{ Form::text('smtp_host', $setting->get('smtp_host', null), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md">
                            <div class="form-label">PORT</div>
                            {{ Form::text('smtp_port', $setting->get('smtp_port', null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-label">ENCRYPTION</div>
                        {{ Form::text('smtp_encryption', $setting->get('smtp_encryption', 'tls'), ['class' => 'form-control']) }}
                        <p id="password-validate" class="card-subtitle text-red"></p>
                    </div>
                    <h3 class="card-title mt-4">Email Setting</h3>
                    {{-- <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.
                    </p> --}}

                    <div class="mb-2">
                        <div class="form-label">From Name</div>
                        {{ Form::text('smtp_from_name', $setting->get('smtp_from_name', null), ['class' => 'form-control']) }}
                        <p id="password-validate" class="card-subtitle text-red"></p>
                    </div>
                    <div class="mb-2">
                        <div class="form-label">From Address</div>
                        {{ Form::text('smtp_from_address', $setting->get('smtp_from_address', null), ['class' => 'form-control']) }}
                        <p id="password-validate" class="card-subtitle text-red"></p>
                    </div>

                    <h3 class="card-title mt-4">Account Setting</h3>
                    <div class="mb-2">
                        <div class="form-label">Username</div>
                        {{ Form::text('smtp_username', $setting->get('smtp_username', null), ['class' => 'form-control']) }}
                        <p id="password-validate" class="card-subtitle text-red"></p>
                    </div>
                    <div class="mb-2">
                        <div class="form-label">Password</div>
                        {{ Form::text('smtp_password', $setting->get('smtp_password', null),['class' => 'form-control']) }}
                        <p id="password-validate" class="card-subtitle text-red"></p>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                        <a href="#" class="btn">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" form="setting">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection