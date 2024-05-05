@extends('layouts.dash')

@section('content')
<main class="content full">
    <a id="btn-toggle" href="#" class="sidebar-toggler break-point-lg">
        <i class="ri-menu-line ri-xl"></i>
    </a>
    {{ Form::model($user, ['route' => ['profile.store'], 'method' => 'PUT']) }}
    <div class="card">
        <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">
                <div class="card-body">
                    <h4 class="subheader">Profile settings</h4>
                    <div class="list-group list-group-transparent">
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">My
                            Account</a>
                    </div>
                    {{-- <h4 class="subheader mt-4">Experience</h4>
                    <div class="list-group list-group-transparent">
                        <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
                    </div> --}}
                </div>
            </div>
            <div class="col d-flex flex-column">
                <div class="card-body">
                    <h2 class="mb-4">My Account</h2>
                    <div class="row g-3">
                        <div class="col-md">
                            <div class="form-label">Name</div>
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <h3 class="card-title mt-4">Email</h3>
                    {{-- <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.
                    </p> --}}
                    <div class="row g-2">
                        <div class="col">
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <h3 class="card-title mt-4">Password</h3>
                    {{-- <p class="card-subtitle">You can set a permanent password if you don't want to use temporary
                        login codes.</p> --}}
                    <div>
                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#change-password">
                            Set new password
                        </a>
                    </div>
                    <h3 class="card-title mt-4">Permissions</h3>
                    <div class="btn-list">
                        @foreach($user->permissions as $permission)
                        <span class="btn">{{ $permission->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                        <a href="#" class="btn">
                            Cancel
                        </a>
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</main>
@endsection

@section('modal')
<div class="modal modal-blur fade" id="change-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['profile.change-password'], 'id'=>'changePassword']) !!}
                <div class="mb-2">
                    <div class="form-label">Password</div>
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
                    <p id="password-validate" class="card-subtitle text-red"></p>
                </div>
                <div>
                    <div class="form-label">Password Confirmation</div>
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) }}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit" form="changePassword">Change</button>
            </div>
        </div>
    </div>   
</div>
@endsection

@push('js_after')
<script type="module">

var formModal = new bs.Modal(document.getElementById('change-password'), {})
$("#changePassword").submit(function(e){
    e.preventDefault();
    let password = $('#password').val()
    let confirm = $('#password_confirmation').val();
    axios.post('{{ route('profile.change-password') }}', {
        'password': password,
        'password_confirmation': confirm
    })
    .then(e => formModal.hide())
    .catch(function(e){
        $('#password-validate').text(e.response.data)
    });
});
</script>
@endpush