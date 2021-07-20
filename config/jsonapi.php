<?php

use Spatie\QueryBuilder\AllowedFilter;

return [
    'resources' => [
        'users' => [
            'domain' => 'Users',
            'relationships' => [
                [
                    'type' => 'roles',
                    'method' => 'roles'
                ],
                [
                    'type' => 'children',
                    'method' => 'children'
                ]
            ],
            'allowedSorts' => [
                'updated_at',
                'email'
            ],
            'allowedFilters' => [

            ]
        ],
        'children' => [
            'domain' => 'Children',
            'relationships' => [
                [
                    'type' => 'users',
                    'method' => 'users'
                ]
            ],
            'allowedSorts' => [
                'updated_at'
            ],
            'allowedFilters' => [

            ]
        ]
    ]
];
