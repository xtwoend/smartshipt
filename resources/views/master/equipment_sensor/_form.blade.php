<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Sensor</label>
            @php
                $sensors = \App\Models\Sensor::where('fleet_id', $equipment->fleet_id)->where('group', $equipment->group)->get()->pluck('name', 'id')->toArray();
                $sensors[NULL] = 'Select Sensor In Equipment';
            @endphp
            {!! Form::select('sensor_id', $sensors, null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('sensor_id'))
                <small class="form-text text-danger">{{ $errors->first('sensor_id') }}</small>
            @endif
        </div>
        <div class="form-group mb-3">
            <label>Sensor Trigger</label>
            @php
                $triggers = \App\Models\Sensor::where('fleet_id', $equipment->fleet_id)->where('group', $equipment->group)->get()->pluck('name', 'sensor_name')->toArray();
                $triggers[NULL] = 'No Sensor Trigger';
            @endphp
            {!! Form::select('sensor_trigger', $triggers ,null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('sensor_trigger'))
                <small class="form-text text-danger">{{ $errors->first('sensor_trigger') }}</small>
            @endif
        </div>
    </div>
</div>
