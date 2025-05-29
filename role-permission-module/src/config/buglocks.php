<?php

return [
    'controllers' => [
        'assign_role' => 'BugLock\rolePermissionModule\Http\Controllers\Assign\RoleController.php'
    ],

    // Middleware Success and Error Messages 
    'middleware' => [
        'sucess' => [],
        'error' => [
            'unauthorized' => 'You are not logged in !',
            'unauthorized-active' => 'Your account is deatived !',
            'unauthorized-role' => 'You do not have access role ',
            'unauthorized-permission'=>'You do not have access permission'
        ]
    ],

    //User authenticable primary key/column
    'primary_key' => 'id',

    // User authenticable primary key/column
    'guard' => 'web',

    //If user have multiple roles 
    'one-to-many-man' => false
];
