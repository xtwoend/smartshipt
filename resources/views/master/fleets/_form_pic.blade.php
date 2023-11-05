<table-editable
    :columns="[
        {
            name: 'Name',
            field: 'pic_name',
            editable: true
        },
        {
            name: 'Occupation',
            field: 'pic_level',
            editable: true
        },
        {
            name: 'Phone',
            field: 'pic_phone',
            editable: true,
        },
        {
            name: 'Email',
            field: 'pic_email',
            editable: true,
            // editType: 'select',
            // options: {{ json_encode(['cc', 'bcc']) }}
        },
        {
            name: 'Primary Email',
            field: 'primary',
            editable: true,
            editType: 'selectKeyVal',
            options: {{ json_encode([0 => 'False', 1 => 'True']) }},
            display: function(row) {
                return row.primary ? 'True': 'False';
            }
        },
    ]"
    :fleet="{{ json_encode($data) }}"
    :data="{{ json_encode($data->pic) }}"
    edit-url="{{ route('master.fleets.pic.update', $data->id) }}"
    del-url="/master/fleets/pic/delete"
></table-editable>