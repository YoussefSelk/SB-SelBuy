<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'SuperAdmin' => [
            'users' => 'c,r,u,d,a',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'Admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'Seller' => [
            'profile' => 'r,u',
        ],
        'Buyer' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'a' => 'create-admin-account',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
