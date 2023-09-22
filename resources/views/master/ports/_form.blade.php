<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Name</label>
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Location</label>
            {!! Form::text('location', null, ['class' => 'form-control']) !!}
            @if ($errors->has('location'))
                <small class="form-text text-danger">{{ $errors->first('location') }}</small>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Latitude</label>
            {!! Form::text('lat', null, ['class' => 'form-control']) !!}
            @if ($errors->has('lat'))
                <small class="form-text text-danger">{{ $errors->first('lat') }}</small>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Longitude</label>
            {!! Form::text('lng', null, ['class' => 'form-control']) !!}
            @if ($errors->has('lng'))
                <small class="form-text text-danger">{{ $errors->first('lng') }}</small>
            @endif
        </div>
    </div>
</div>
