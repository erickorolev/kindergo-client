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
                ]
            ],
            'allowedSorts' => [
                'updated_at',
                'email'
            ],
            'allowedFilters' => [

            ]
        ]
    ]
];
