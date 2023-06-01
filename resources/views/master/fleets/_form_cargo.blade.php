<div class="row">
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Group Tank</label>
            {!! Form::number('group', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('group'))
                <small class="form-text text-danger">{{ $errors->first('group') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Jumlah Cargo Tank</label>
            {!! Form::number('total', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('total'))
                <small class="form-text text-danger">{{ $errors->first('total') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Cargo Grade</label>
            {!! Form::text('grade', null, ['class' => 'form-control', ($disabled ?? '')]) !!}
            @if ($errors->has('grade'))
                <small class="form-text text-danger">{{ $errors->first('grade') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Cargo Capacity Tank (%)</label>
            {!! Form::number('capacity_percentage', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('capacity_percentage'))
                <small class="form-text text-danger">{{ $errors->first('capacity_percentage') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Cargo Capacity Tank</label>
            {!! Form::number('capacity', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('capacity'))
                <small class="form-text text-danger">{{ $errors->first('capacity') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>Cargo Capacity Tank (SG)</label>
            {!! Form::number('capacity_sg', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('capacity_sg'))
                <small class="form-text text-danger">{{ $errors->first('capacity_sg') }}</small>
            @endif
        </div>
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>MAX Load Cargo Capacity (%)</label>
            {!! Form::number('max_capacity', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('max_capacity'))
                <small class="form-text text-danger">{{ $errors->first('max_capacity') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>MAX Load Cargo Capacity</label>
            {!! Form::number('max_capacity_percentage', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('max_capacity_percentage'))
                <small class="form-text text-danger">{{ $errors->first('max_capacity_percentage') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>MAX Load Cargo Capacity (SG)</label>
            {!! Form::number('max_capacity_sg', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('max_capacity_sg'))
                <small class="form-text text-danger">{{ $errors->first('max_capacity_sg') }}</small>
            @endif
        </div>
    </div>
</div>
