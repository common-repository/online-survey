<?php
return [  
    [
        'name'     => __( 'Group Title', 'online-survey' ),
        'id'       => $prefix . 'title',
        'type'     => 'text',
        'tab'      => $tab
    ],  
    [
        'name'     => __( 'Group Subtitle', 'online-survey' ),
        'id'       => $prefix . 'subtitle',
        'type'     => 'textarea',
        'tab'      => $tab
    ],
    [
        'name'     => __( 'Questions', 'online-survey' ),
        'id'       => $prefix . 'questions',
        'type'              => 'group',
        'clone'             => true,
        'clone_default'     => true,
        'clone_as_multiple' => true,  
        'collapsible'   => true,
        'default_state'   => 'collapsed',
        'group_title'   => '{#}. {name} ({type})',      
        'add_button'        => __( 'Add Question', 'online-survey' ),
        'tab'      => $tab,
        'fields'    => [
            [
                'name'     => __( 'Question', 'online-survey' ),
                'id'       => 'name',
                'type'     => 'text',
                'std'     => __( 'Question 1?', 'online-survey' ),
                'placeholder'     => __( 'Enter Question here', 'online-survey' ),
                'required' => true
            ],
            [
                'name'     => __( 'Answer type', 'online-survey' ),
                'id'       => 'type',
                'std'      => 'text',
                'type'     => 'select',
                'required' => true,
                'options' => [
                    'text' => 'Text field',
                    'textarea' => 'Shot description',
                    'number' => 'Number',
                    'switch' => 'Switch',
                    'radio' => 'Single Choice',
                    'checkbox' => 'Multiple select',
                                        
                ]
            ],
            [
                'name'     => __( 'Minimum', 'online-survey' ),
                'id'       => 'min',
                'type'     => 'number',
                'std'      => '0',
                'visible' => ['type', '=', 'number']
            ],
            [
                'name'     => __( 'Maximum', 'online-survey' ),
                'id'       => 'max',
                'type'     => 'number',
                'visible' => ['type', '=', 'number']
            ],
            [
                'name'     => __( 'Placeholder', 'online-survey' ),
                'id'       => 'placeholder',
                'type'     => 'text',
                'visible' => ['type', 'in', ['text', 'textarea']]
            ],
            [
                'name'     => __( 'Choices', 'online-survey' ),
                'id'       => 'options',
                'type'     => 'key_value',
                'visible' => ['type', 'in', ['radio', 'checkbox']]
            ],
            [
                'name'     => __( 'Description', 'online-survey' ),
                'id'       => 'desc',
                'type'     => 'textarea',
                'desc' => __( 'Enter short description for the question.', 'online-survey' ),
            ],
        ],
    ],
    [
        'name'     => __( 'Footer description', 'online-survey' ),
        'id'       => $prefix . 'footer',
        'type'     => 'wysiwyg',
        'options' => [
            'textarea_rows' => 6,
            'teeny'         => true,
            'media_buttons' => false
        ],
        'tab'      => $tab
    ],
    
];