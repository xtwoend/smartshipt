<div class="col-12">
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            @php
                $mimic = $fleet->mimic()->where('group', 'fuel')->first();
            @endphp
            <fleet-svg-upload path="{{ $mimic?->path }}" group="fuel" fleet-id="{{ $fleet->id }}"></fleet-svg-upload>
        </div>
    </div>
</div>

<br>

<table-editable
    :columns="[
        {
            name: 'Name',
            field: 'name',
            editable: true
        },
        {
            name: 'Sensor Name',
            field: 'sensor_name',
            editable: true,
            editType: 'select',
            options: {{ json_encode($sensors) }}
        },
        {
            name: 'Unit',
            field: 'unit',
            editable: true,
            isHtml: true
        },
        {
            name: 'Low',
            field: 'normal',
            editable: true
        },
        {
            name: 'Max Normal',
            field: 'max_normal',
            editable: true
        },
        {
            name: 'High',
            field: 'danger',
            editable: true
        },
        {
            name: 'Min Value',
            field: 'min',
            editable: true
        },
        {
            name: 'Max Value',
            field: 'max',
            editable: true
        },
        {
            name: 'Convert Percentage',
            field: 'is_percentage',
            editable: true,
            editType: 'selectKeyVal',
            options: {{ json_encode([0 => 'No', 1 => 'Yes, With Ullage', 2 => 'Yes, With Level']) }},
            display: function(row) {
                let selects = ['No', 'Yes, With Ullage', 'Yes, With Level'];
                return selects[row.is_percentage] ? selects[row.is_percentage] : 'No';
            }
        },
        {
            name: 'AMS Mark',
            field: 'is_ams',
            editable: true,
            editType: 'selectKeyVal',
            options: {{ json_encode([0 => 'False', 1 => 'True']) }},
            display: function(row) {
                return row.is_ams ? 'True': 'False';
            }
        },
    ]"
    :fleet="{fleetId: {{ $fleet->id }}, group: 'fuel', ordered: 4 }"
    :data="{{ json_encode($lists) }}"
    edit-url="{{ route('master.sensors.edit') }}"
    del-url="/master/sensors/delete"
    @can('Fleet Threshold Sensor Setting')
    editable
    @endcan
></table-editable>