<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label>Speed Service</label>
            {!! Form::number('speed_service', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('speed_service'))
                <small class="form-text text-danger">{{ $errors->first('speed_service') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Pumping Rate / Hour</label>
            {!! Form::number('pumping_rate', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('pumping_rate'))
                <small class="form-text text-danger">{{ $errors->first('pumping_rate') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Presure Discharge</label>
            {!! Form::number('presure_discharge', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('presure_discharge'))
                <small class="form-text text-danger">{{ $errors->first('presure_discharge') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Loading Rate</label>
            {!! Form::number('loading_rate', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('loading_rate'))
                <small class="form-text text-danger">{{ $errors->first('loading_rate') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Commision Days</label>
            {!! Form::number('commision_days', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('commision_days'))
                <small class="form-text text-danger">{{ $errors->first('commision_days') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Transport Loss - R2</label>
            {!! Form::number('transport_loss', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01']) !!}
            @if ($errors->has('transport_loss'))
                <small class="form-text text-danger">{{ $errors->first('transport_loss') }}</small>
            @endif
        </div>
    </div>
</div>
