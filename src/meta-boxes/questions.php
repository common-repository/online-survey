<?php
$prefix = '';
$tabs = [
    'general'     => [
        'label' => 'General',
        'icon'  => 'dashicons-info',
    ],
    'survey'     => [
        'label' => 'Questions',
        'icon'  => 'dashicons-editor-help',
    ],
    'advanced'     => [
        'label' => 'Advaned',
        'icon'  => 'dashicons-admin-generic',
    ],
    
];
$fields = [];
foreach ($tabs as $tab => $value) {
    $file = __DIR__ ."/survey/{$tab}.php";
    if( file_exists($file) ){
        $new_fields = include $file;
        $fields = array_merge($fields, $new_fields);
    }    
}


return [
    'title'      => __( 'Survey Settings', 'online-survey' ),
    'id'         => 'questions-data',
    'post_types' => ['survey'],
    'tab_style'  => 'left',
    'tabs'       => $tabs,
    'fields'     => $fields
];