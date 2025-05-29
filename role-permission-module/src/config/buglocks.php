<?php

return [
    'controllers' => [
        'assign_role'=>'BugLock\rolePermissionModule\Http\Controllers\Assign\RoleController.php'
    ],

    //User authenticable primary key/column
    'primary_key'=>'id',

    // User authenticable primary key/column
    'guard'=>'web',

    //If user have multiple roles 
    'one-to-many-man'=>false
];
