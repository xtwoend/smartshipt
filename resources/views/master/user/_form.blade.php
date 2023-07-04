<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Name</label>
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Email</label>
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Password</label>
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
                <small class="form-text text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Confirm Password</label>
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
