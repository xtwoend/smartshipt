<div class="row">
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED LADEN</label>
            {!! Form::number('max_speed_laden', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_laden'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_laden') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED LADEN MFO</label>
            {!! Form::number('max_speed_laden_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_laden_mfo'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_laden_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED LADEN MDO</label>
            {!! Form::number('max_speed_laden_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_laden_mdo'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_laden_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED LADEN HSD</label>
            {!! Form::number('max_speed_laden_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_laden_hsd'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_laden_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED BALLAST</label>
            {!! Form::number('max_speed_ballast', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_ballast'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_ballast') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED BALLAST MFO</label>
            {!! Form::number('max_speed_ballast_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_ballast_mfo'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_ballast_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED BALLAST MDO</label>
            {!! Form::number('max_speed_ballast_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_ballast_mdo'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_ballast_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>MAX SPEED BALLAST HSD</label>
            {!! Form::number('max_speed_ballast_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('max_speed_ballast_hsd'))
                <small class="form-text text-danger">{{ $errors->first('max_speed_ballast_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) LADEN MFO</label>
            {!! Form::number('sea_laden_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_laden_mfo'))
                <small class="form-text text-danger">{{ $errors->first('sea_laden_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) LADEN MDO</label>
            {!! Form::number('sea_laden_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_laden_mdo'))
                <small class="form-text text-danger">{{ $errors->first('sea_laden_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) LADEN HSD</label>
            {!! Form::number('sea_laden_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_laden_hsd'))
                <small class="form-text text-danger">{{ $errors->first('sea_laden_hsd') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) LADEN (day)</label>
            {!! Form::number('sea_laden_day', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_laden_day'))
                <small class="form-text text-danger">{{ $errors->first('sea_laden_day') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) BALLAST MFO</label>
            {!! Form::number('sea_ballast_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_ballast_mfo'))
                <small class="form-text text-danger">{{ $errors->first('sea_ballast_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) BALLAST MDO</label>
            {!! Form::number('sea_ballast_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_ballast_mdo'))
                <small class="form-text text-danger">{{ $errors->first('sea_ballast_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) BALLAST HSD</label>
            {!! Form::number('sea_ballast_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_ballast_hsd'))
                <small class="form-text text-danger">{{ $errors->first('sea_ballast_hsd') }}</small>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="form-group mb-3">
            <label>BUNKER (SEA) BALLAST (day)</label>
            {!! Form::number('sea_ballast_day', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('sea_ballast_day'))
                <small class="form-text text-danger">{{ $errors->first('sea_ballast_day') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER DISCHARGE MFO</label>
            {!! Form::number('discharge_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('discharge_mfo'))
                <small class="form-text text-danger">{{ $errors->first('discharge_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER DISCHARGE MDO</label>
            {!! Form::number('discharge_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('discharge_mdo'))
                <small class="form-text text-danger">{{ $errors->first('discharge_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER DISCHARGE HSD</label>
            {!! Form::number('discharge_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('discharge_hsd'))
                <small class="form-text text-danger">{{ $errors->first('discharge_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER LOADING MFO</label>
            {!! Form::number('loading_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('loading_mfo'))
                <small class="form-text text-danger">{{ $errors->first('loading_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER LOADING MDO</label>
            {!! Form::number('loading_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('loading_mdo'))
                <small class="form-text text-danger">{{ $errors->first('loading_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER LOADING HSD</label>
            {!! Form::number('loading_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('loading_hsd'))
                <small class="form-text text-danger">{{ $errors->first('loading_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER IDLE MFO</label>
            {!! Form::number('idle_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('idle_mfo'))
                <small class="form-text text-danger">{{ $errors->first('idle_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER IDLE MDO</label>
            {!! Form::number('idle_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('idle_mdo'))
                <small class="form-text text-danger">{{ $errors->first('idle_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER IDLE HSD</label>
            {!! Form::number('idle_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('idle_hsd'))
                <small class="form-text text-danger">{{ $errors->first('idle_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER MANOVERING MFO</label>
            {!! Form::number('manovering_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('manovering_mfo'))
                <small class="form-text text-danger">{{ $errors->first('manovering_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER MANOVERING MDO</label>
            {!! Form::number('manovering_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('manovering_mdo'))
                <small class="form-text text-danger">{{ $errors->first('manovering_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER MANOVERING HSD</label>
            {!! Form::number('manovering_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('manovering_hsd'))
                <small class="form-text text-danger">{{ $errors->first('manovering_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER CLEANING/PURGIN/GASING UP MFO</label>
            {!! Form::number('cleaning_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('cleaning_mfo'))
                <small class="form-text text-danger">{{ $errors->first('cleaning_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER CLEANING/PURGIN/GASING UP MDO</label>
            {!! Form::number('cleaning_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('cleaning_mdo'))
                <small class="form-text text-danger">{{ $errors->first('cleaning_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER CLEANING/PURGIN/GASING UP HSD</label>
            {!! Form::number('cleaning_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('cleaning_hsd'))
                <small class="form-text text-danger">{{ $errors->first('cleaning_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER HEATING MFO</label>
            {!! Form::number('heating_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('heating_mfo'))
                <small class="form-text text-danger">{{ $errors->first('heating_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER HEATING MDO</label>
            {!! Form::number('heating_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('heating_mdo'))
                <small class="form-text text-danger">{{ $errors->first('heating_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER HEATING HSD</label>
            {!! Form::number('heating_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('heating_hsd'))
                <small class="form-text text-danger">{{ $errors->first('heating_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER BALLASTING MFO</label>
            {!! Form::number('ballasting_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('ballasting_mfo'))
                <small class="form-text text-danger">{{ $errors->first('ballasting_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER BALLASTING MDO</label>
            {!! Form::number('ballasting_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('ballasting_mdo'))
                <small class="form-text text-danger">{{ $errors->first('ballasting_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER BALLASTING HSD</label>
            {!! Form::number('ballasting_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('ballasting_hsd'))
                <small class="form-text text-danger">{{ $errors->first('ballasting_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER DEBALLASTING MFO</label>
            {!! Form::number('deballasting_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('deballasting_mfo'))
                <small class="form-text text-danger">{{ $errors->first('deballasting_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER DEBALLASTING MDO</label>
            {!! Form::number('deballasting_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('deballasting_mdo'))
                <small class="form-text text-danger">{{ $errors->first('deballasting_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER DEBALLASTING HSD</label>
            {!! Form::number('deballasting_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('deballasting_hsd'))
                <small class="form-text text-danger">{{ $errors->first('deballasting_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER TANK CAPACITY (M3) MFO</label>
            {!! Form::number('tank_capacity_mfo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('tank_capacity_mfo'))
                <small class="form-text text-danger">{{ $errors->first('tank_capacity_mfo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER TANK CAPACITY (M3) MDO</label>
            {!! Form::number('tank_capacity_mdo', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('tank_capacity_mdo'))
                <small class="form-text text-danger">{{ $errors->first('tank_capacity_mdo') }}</small>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group mb-3">
            <label>BUNKER TANK CAPACITY (M3) HSD</label>
            {!! Form::number('tank_capacity_hsd', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('tank_capacity_hsd'))
                <small class="form-text text-danger">{{ $errors->first('tank_capacity_hsd') }}</small>
            @endif
        </div>
    </div>

    <div class="col-12">
        <hr class="col-12 mt-2 mb-3">
    </div>

    <div class="col-6">
        <div class="form-group mb-3">
            <label>Speed Service (KNOT)</label>
            {!! Form::number('speed_service', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('speed_service'))
                <small class="form-text text-danger">{{ $errors->first('speed_service') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Pumping Rate / Hour</label>
            {!! Form::number('pumping_rate', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('pumping_rate'))
                <small class="form-text text-danger">{{ $errors->first('pumping_rate') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Presure Discharge</label>
            {!! Form::number('presure_discharge', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('presure_discharge'))
                <small class="form-text text-danger">{{ $errors->first('presure_discharge') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Loading Rate</label>
            {!! Form::number('loading_rate', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('loading_rate'))
                <small class="form-text text-danger">{{ $errors->first('loading_rate') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Commision Days</label>
            {!! Form::number('commision_days', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('commision_days'))
                <small class="form-text text-danger">{{ $errors->first('commision_days') }}</small>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-3">
            <label>Transport Loss - R2</label>
            {!! Form::number('transport_loss', null, ['class' => 'form-control', ($disabled ?? ''), 'step' => '0.01', 'min' => 0]) !!}
            @if ($errors->has('transport_loss'))
                <small class="form-text text-danger">{{ $errors->first('transport_loss') }}</small>
            @endif
        </div>
    </div>
</div>
