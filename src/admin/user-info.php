<?php
return [   
    [
        'id'          => 'created_at',
        'type'        => 'datetime',
        'name'        => 'Created at',
        'js_options'  => [
            'timeFormat' => 'HH:mm:ss',
        ],
        'admin_columns' => true,
    ],
    [
        'id'     => 'fullname',
        'type'   => 'text',
        'name'   => 'Name',
        'admin_columns' => [
            'searchable' => true,
        ],					
    ],
    [
        'id'   => 'email',
        'type' => 'email',
        'name' => 'Email',
        'admin_columns' => [
            'searchable' => true,
        ],
    ],
    [
        'id'   => 'phone',
        'name' => 'Phone',
        'admin_columns' => true,
        'admin_columns' => [
            'searchable' => true,
        ],
    ],
    [
        'id'   => 'status',
        'type' => 'select',
        'name' => 'Status',
        'options' => [
            'pending'   => 'Pending',
            'completed' => 'Completed',
            'replied'  => 'Replied',
        ],
        'admin_columns' => [
            'link'       => 'edit',
            'sort'       => true,
            'sortable' => true,
            'filterable' => true
        ]
    ],
    [
        'id'            => 'screenshot',
        'type'          => 'image_advanced',
        'name'          => 'Screenshots',
        'admin_columns' => true,
    ],
];