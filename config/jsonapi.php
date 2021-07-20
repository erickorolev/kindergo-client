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
                ],
                [
                    'type' => 'timetables',
                    'method' => 'timetables'
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
                ],
                [
                    'type' => 'timetables',
                    'method' => 'timetables'
                ]
            ],
            'allowedSorts' => [
                'updated_at'
            ],
            'allowedFilters' => [

            ]
        ],
        'timetables' => [
            'domain' => 'Timetables',
            'relationships' => [
                [
                    'type' => 'user',
                    'method' => 'user'
                ],
                [
                    'type' => 'children',
                    'method' => 'children'
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
