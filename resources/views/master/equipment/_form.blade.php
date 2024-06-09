<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Name</label>
            {!! Form::text('name', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('name'))
                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Group</label>
            {!! Form::select('group', ['engine' => 'Main Engine', 'cargo_pump' => 'Cargo Pump'], null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('name'))
                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Last Maintenance</label>
            {!! Form::date('last_maintenance', null, ['class' => 'form-control date', ($disabled ?? '')]) !!}
            @if ($errors->has('last_maintenance'))
                <small class="form-text text-danger">{{ $errors->first('last_maintenance') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Schedule Maintenance</label>
            {!! Form::date('schedule_maintenance', null, ['class' => 'form-control date', ($disabled ?? '')]) !!}
            @if ($errors->has('schedule_maintenance'))
                <small class="form-text text-danger">{{ $errors->first('schedule_maintenance') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Target Repaire In Hours</label>
            {!! Form::text('lifetime_hours', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('lifetime_hours'))
                <small class="form-text text-danger">{{ $errors->first('lifetime_hours') }}</small>
            @endif
        </div>
    </div>
</div>
