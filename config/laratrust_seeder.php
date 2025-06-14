<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'reservations' => 'c,r,d',
            'reports' => 'r',
            'dashboard' => 'r',
        ],
        'approver_level1' => [
            'reservations' => 'r,u',
            'dashboard' => 'r',
            'reports' => 'r',
        ],
        'approver_level2' => [
            'reservations' => 'r,u',
            'dashboard' => 'r',
            'reports' => 'r',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
