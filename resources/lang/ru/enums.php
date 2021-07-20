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
    ],
    \Domains\Timetables\Enums\TimetableStatusEnum::class => [
        \Domains\Timetables\Enums\TimetableStatusEnum::PERFORMED => 'Создан',
        \Domains\Timetables\Enums\TimetableStatusEnum::PENDING => 'В ожидании',
        \Domains\Timetables\Enums\TimetableStatusEnum::COMPLETED => 'Оплачен',
        \Domains\Timetables\Enums\TimetableStatusEnum::CANCELED => 'Отменён'
    ]
];
