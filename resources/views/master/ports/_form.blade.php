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
    {{-- pinned map --}}
    @if(isset($data))
    <map-pinned lat="{{ $data->lat }}" lng="{{ $data->lng }}" style="height: 200px; width:100%;"></map-pinned>
    @else
    <map-pinned lat="-5.101189" lng="112.421518" style="height: 200px; width:100%;"></map-pinned>
    @endif
</div>
