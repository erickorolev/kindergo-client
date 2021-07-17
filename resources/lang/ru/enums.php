<?php

return [
    \Parents\Enums\GenderEnum::class => [
        \Parents\Enums\GenderEnum::FEMALE => 'Женский',
        \Parents\Enums\GenderEnum::MALE => 'Мужской',
        \Parents\Enums\GenderEnum::OTHER => 'Другой'
    ],
    \Domains\Users\Enums\AttendantGenderEnum::class => [
        \Domains\Users\Enums\AttendantGenderEnum::FEMALE => 'Женский',
        \Domains\Users\Enums\AttendantGenderEnum::MALE => 'Мужской',
        \Domains\Users\Enums\AttendantGenderEnum::NO_MATTER => 'Без разницы',
    ]
];
