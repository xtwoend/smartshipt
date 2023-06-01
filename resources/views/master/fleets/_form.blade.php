<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Name</label>
            {!! Form::text('name', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('name'))
                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Owner</label>
            {!! Form::text('owner', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('owner'))
                <small class="form-text text-danger">{{ $errors->first('owner') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Ship Manager</label>
            {!! Form::text('ship_manager', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('ship_manager'))
                <small class="form-text text-danger">{{ $errors->first('ship_manager') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Cargo</label>
            {!! Form::text('cargo', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('cargo'))
                <small class="form-text text-danger">{{ $errors->first('cargo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Type</label>
            {!! Form::text('type', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('type'))
                <small class="form-text text-danger">{{ $errors->first('type') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Email</label>
            {!! Form::email('email', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('email'))
                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Phone</label>
            {!! Form::tel('telp', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('telp'))
                <small class="form-text text-danger">{{ $errors->first('telp') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Cal Sign</label>
            {!! Form::text('call_sign', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('call_sign'))
                <small class="form-text text-danger">{{ $errors->first('call_sign') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>IMO Number</label>
            {!! Form::tel('imo_number', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('imo_number'))
                <small class="form-text text-danger">{{ $errors->first('imo_number') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Builder</label>
            {!! Form::text('builder', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('builder'))
                <small class="form-text text-danger">{{ $errors->first('builder') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Year Built</label>
            {!! Form::number('year', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('year'))
                <small class="form-text text-danger">{{ $errors->first('year') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Flag</label>
            {!! Form::text('flag', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('flag'))
                <small class="form-text text-danger">{{ $errors->first('flag') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Home Port</label>
            {!! Form::text('home_port', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('home_port'))
                <small class="form-text text-danger">{{ $errors->first('home_port') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Class</label>
            {!! Form::text('class', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('class'))
                <small class="form-text text-danger">{{ $errors->first('class') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>MMSI</label>
            {!! Form::tel('mmsi', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('mmsi'))
                <small class="form-text text-danger">{{ $errors->first('mmsi') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Length (m)</label>
            {!! Form::number('length', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('length'))
                <small class="form-text text-danger">{{ $errors->first('length') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Breadth (m)</label>
            {!! Form::number('breadth', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('breadth'))
                <small class="form-text text-danger">{{ $errors->first('breadth') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Death (m)</label>
            {!! Form::number('death', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('death'))
                <small class="form-text text-danger">{{ $errors->first('death') }}</small>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="form-group mb-3">
            <label>DWT</label>
            {!! Form::number('dwt', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('dwt'))
                <small class="form-text text-danger">{{ $errors->first('dwt') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>GRT</label>
            {!! Form::number('grt', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('grt'))
                <small class="form-text text-danger">{{ $errors->first('grt') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>NRT</label>
            {!! Form::number('nrt', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('nrt'))
                <small class="form-text text-danger">{{ $errors->first('nrt') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>LWT</label>
            {!! Form::number('lwt', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('lwt'))
                <small class="form-text text-danger">{{ $errors->first('lwt') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Draft (m)</label>
            {!! Form::number('draft', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('draft'))
                <small class="form-text text-danger">{{ $errors->first('draft') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Derrick Capacity / SWL (Ton)</label>
            {!! Form::number('swl', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('swl'))
                <small class="form-text text-danger">{{ $errors->first('swl') }}</small>
            @endif
        </div>
    </div>
</div>
