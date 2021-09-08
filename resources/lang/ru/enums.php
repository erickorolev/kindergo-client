<?php

return [
    \Parents\Enums\GenderEnum::class => [
        \Parents\Enums\GenderEnum::FEMALE => 'Женский',
        \Parents\Enums\GenderEnum::MALE => 'Мужской',
        \Parents\Enums\GenderEnum::OTHER => 'Не указано'
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
    ],
    \Domains\Payments\Enums\TypePaymentEnum::class => [
        \Domains\Payments\Enums\TypePaymentEnum::BANK_PAYMENT => 'Банковская транзакция',
        \Domains\Payments\Enums\TypePaymentEnum::ONLINE_PAYMENT => 'Онлайн платёж',
        \Domains\Payments\Enums\TypePaymentEnum::NOT_SPECIFIED => 'Не указано'
    ],
    \Domains\Payments\Enums\SpStatusEnum::class => [
        \Domains\Payments\Enums\SpStatusEnum::NOT_SPECIFIED => 'Не указано',
        \Domains\Payments\Enums\SpStatusEnum::SCHEDULED => 'Запланирован',
        \Domains\Payments\Enums\SpStatusEnum::EXECUTED => 'Выполнен',
        \Domains\Payments\Enums\SpStatusEnum::CANCELED => 'Отменён',
        \Domains\Payments\Enums\SpStatusEnum::DELAYED => 'Просрочен'
    ],
    \Domains\Trips\Enums\TripStatusEnum::class => [
        \Domains\Trips\Enums\TripStatusEnum::APPOINTED => 'Назначено',
        \Domains\Trips\Enums\TripStatusEnum::PERFORMED => 'Выполняется',
        \Domains\Trips\Enums\TripStatusEnum::COMPLETED => 'Завершена',
        \Domains\Trips\Enums\TripStatusEnum::CANCELED => 'Отменена',
        \Domains\Trips\Enums\TripStatusEnum::PENDING => 'В ожидании'
    ]
];
