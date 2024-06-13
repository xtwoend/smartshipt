<div class="col-12">
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            @php
                $mimic = $fleet->mimic()->where('group', 'draft')->first();
            @endphp
            <fleet-svg-upload path="{{ $mimic?->path }}" group="draft" fleet-id="{{ $fleet->id }}"></fleet-svg-upload>
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
    :fleet="{fleetId: {{ $fleet->id }}, group: 'draft', ordered: 7 }"
    :data="{{ json_encode($lists) }}"
    edit-url="{{ route('master.sensors.edit') }}"
    del-url="/master/sensors/delete"
    @can('Fleet Threshold Sensor Setting')
    editable
    @endcan
></table-editable>