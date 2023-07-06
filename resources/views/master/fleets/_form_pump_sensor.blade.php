
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
            editable: true
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
    :data="{{ json_encode($lists) }}"
    edit-url="{{ route('master.sensors.edit') }}"
    :sensor-list="{{ json_encode($sensors) }}"
></table-editable>