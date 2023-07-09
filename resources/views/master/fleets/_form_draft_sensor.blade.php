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
            name: 'Normal Value (%)',
            field: 'normal',
            editable: true
        },
        {
            name: 'Warning Value (%)',
            field: 'danger',
            editable: true
        },
        {
            name: 'Max Value',
            field: 'max',
            editable: true
        },
    ]"
    :fleet="{fleetId: {{ $fleet->id }}, group: 'draft'}"
    :data="{{ json_encode($lists) }}"
    edit-url="{{ route('master.sensors.edit') }}"
    del-url="/master/sensors/delete"
></table-editable>