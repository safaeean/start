<?php

return [
    'admin_name' => 'Admin',
    'admin_email' => 'admin@localhost',
    'admin_password' => '12345678',
    'admin_roles' => ['root'],

    'permissions' => [

    ],

    'roles' => [
        [
            'name' => 'root',
            'guard_name' => 'root',
            'permissions' => []
        ]
    ]
];
