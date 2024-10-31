<?php
return [  
    [
        'name'     => __( 'Basic info Title', 'online-survey' ),
        'id'       => 'basic_info_title',
        'type'     => 'text',
        'std'     => __( 'Basic information', 'online-survey' ),
        'tab'      => $tab
    ],  
    [
        'name'     => __( 'Basic info Subtitle', 'online-survey' ),
        'id'       => 'basic_info_subtitle',
        'type'     => 'textarea',
        'tab'      => $tab
    ],    
    [
        'name'     => __( 'Button text', 'online-survey' ),
        'id'       => $prefix . 'button_text',
        'type'     => 'text',
        'std'     => 'Submit',
        'tab'      => $tab
    ],
    
    
];