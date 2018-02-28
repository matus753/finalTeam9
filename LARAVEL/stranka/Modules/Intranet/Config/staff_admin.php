<?php

return [
    'name' => 'Staff',
    'x_rule' => true,
    'gender_rule' => true,
    'activation' => true,
    'default_imgs' => [
        'default_img' => 'default_img.png',
        'default_female_img' => 'default_female_img.png',
        'default_male_img' => 'default_male_img.png',
    ],
   
    'departments' => [
        'AHU' => 'AHU',
        'OAMM' => 'OAMM',
        'OEAP' => 'OEAP',
        'OEMP' => 'OEMP',
        'OIKR' => 'OIKR'
    ],

    'rolesSK' => [
        'doktorand' => 'doktorant',
        'researcher' => 'výskumník',
        'teacher' => 'učiteľ',
    ],

    'rolesEN' => [
        'doktorand' => 'doktorand',
        'researcher' => 'researcher',
        'teacher' => 'teacher',
    ],

    'permission_roles' => [
        //'user' => 'User', logicky neni automaticky kazdy user ?
        'hr' => 'HR',
        'reporter' => 'Reporter',
        'editor' => 'Editor',
        'admin' => 'Admin',
    ]
];
