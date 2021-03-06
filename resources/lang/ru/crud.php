<?php

return [
    'common' => [
        'actions' => 'Действия',
        'create' => 'Создать',
        'edit' => 'Редактировать',
        'update' => 'Обновить',
        'new' => 'Новый',
        'cancel' => 'Отменить',
        'save' => 'Сохранить',
        'delete' => 'Удалить',
        'delete_selected' => 'Удалить выбранное',
        'search' => 'Поиск...',
        'back' => 'Вернуться к списку',
        'are_you_sure' => 'Вы уверены?',
        'no_items_found' => 'Записей не найдено',
        'created' => 'Создано успешно',
        'saved' => 'Сохранено успешно',
        'removed' => 'Удалено успешно',
    ],

    'users' => [
        'name' => 'Пользователи',
        'index_title' => 'Список пользователей',
        'new_title' => 'Новый пользователь',
        'create_title' => 'Создать пользователя',
        'edit_title' => 'Редактировать пользователя',
        'show_title' => 'Показать пользователя',
        'inputs' => [
            'name' => 'Имя',
            'email' => 'Адрес электронной почты',
            'password' => 'Пароль',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Номер телефона',
            'attendant_gender' => 'Пол сопровождающего',
            'otherphone' => 'Другой телефон',
            'imagename' => 'Изображение',
        ],
    ],

    'user_timetables' => [
        'name' => 'User Timetables',
        'index_title' => 'Timetables List',
        'new_title' => 'New Timetable',
        'create_title' => 'Create Timetable',
        'edit_title' => 'Edit Timetable',
        'show_title' => 'Show Timetable',
        'inputs' => [
            'name' => 'Name',
            'where_address' => 'Where Address',
            'trips' => 'Trips',
            'childrens' => 'Childrens',
            'childrens_age' => 'Childrens Age',
            'date' => 'Date',
            'time' => 'Time',
            'duration' => 'Duration',
            'distance' => 'Distance',
            'scheduled_wait_from' => 'Scheduled Wait From',
            'scheduled_wait_where' => 'Scheduled Wait Where',
            'status' => 'Status',
            'bill_paid' => 'Bill Paid',
            'description' => 'Description',
            'parking_info' => 'Parking Info',
        ],
    ],

    'timetable_trips' => [
        'name' => 'Timetable Trips',
        'index_title' => 'Trips List',
        'new_title' => 'New Trip',
        'create_title' => 'Create Trip',
        'edit_title' => 'Edit Trip',
        'show_title' => 'Show Trip',
        'inputs' => [
            'name' => 'Name',
            'where_address' => 'Where Address',
            'date' => 'Date',
            'time' => 'Time',
            'childrens' => 'Childrens',
            'status' => 'Status',
            'attendant_id' => 'Attendant',
        ],
    ],

    'user_payments' => [
        'name' => 'User Payments',
        'index_title' => 'Payments List',
        'new_title' => 'New Payment',
        'create_title' => 'Create Payment',
        'edit_title' => 'Edit Payment',
        'show_title' => 'Show Payment',
        'inputs' => [
            'pay_date' => 'Pay Date',
            'type_payment' => 'Type Payment',
            'amount' => 'Amount',
            'spstatus' => 'Spstatus',
        ],
    ],

    'children' => [
        'name' => 'Дети',
        'index_title' => 'Список детей',
        'new_title' => 'Новый ребёнок',
        'create_title' => 'Создать ребёнка',
        'edit_title' => 'Редактировать ребёнка',
        'show_title' => 'Показать ребёнка',
        'inputs' => [
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'middle_name' => 'Отчество',
            'birthday' => 'День рождения',
            'gender' => 'Пол',
            'phone' => 'Номер телефона',
            'otherphone' => 'Другой телефон',
            'imagename' => 'Изображение',
        ],
    ],

    'attendants' => [
        'name' => 'Attendants',
        'index_title' => 'Attendants List',
        'new_title' => 'New Attendant',
        'create_title' => 'Create Attendant',
        'edit_title' => 'Edit Attendant',
        'show_title' => 'Show Attendant',
        'inputs' => [
            'firstname' => 'Firstname',
            'latname' => 'Latname',
            'middle_name' => 'Middle Name',
            'phone' => 'Phone',
            'resume' => 'Resume',
            'car_model' => 'Car Model',
            'car_year' => 'Car Year',
            'email' => 'Email',
            'gender' => 'Gender',
            'imagename' => 'Imagename',
        ],
    ],

    'attendant_trips' => [
        'name' => 'Attendant Trips',
        'index_title' => 'Trips List',
        'new_title' => 'New Trip',
        'create_title' => 'Create Trip',
        'edit_title' => 'Edit Trip',
        'show_title' => 'Show Trip',
        'inputs' => [
            'name' => 'Name',
            'where_address' => 'Where Address',
            'date' => 'Date',
            'time' => 'Time',
            'childrens' => 'Childrens',
            'status' => 'Status',
            'timetable_id' => 'Timetable',
        ],
    ],

    'timetables' => [
        'name' => 'Timetables',
        'index_title' => 'Timetables List',
        'new_title' => 'New Timetable',
        'create_title' => 'Create Timetable',
        'edit_title' => 'Edit Timetable',
        'show_title' => 'Show Timetable',
        'inputs' => [
            'name' => 'Name',
            'where_address' => 'Where Address',
            'trips' => 'Trips',
            'childrens' => 'Childrens',
            'childrens_age' => 'Childrens Age',
            'date' => 'Date',
            'time' => 'Time',
            'duration' => 'Duration',
            'distance' => 'Distance',
            'scheduled_wait_from' => 'Scheduled Wait From',
            'scheduled_wait_where' => 'Scheduled Wait Where',
            'status' => 'Status',
            'bill_paid' => 'Bill Paid',
            'description' => 'Description',
            'parking_info' => 'Parking Info',
            'user_id' => 'User',
        ],
    ],

    'payments' => [
        'name' => 'Платежи',
        'index_title' => 'Список платежей',
        'new_title' => 'Новый платёж',
        'create_title' => 'Создать платёж',
        'edit_title' => 'Редактировать платёж',
        'show_title' => 'Показать платёж',
        'inputs' => [
            'pay_date' => 'Дата платежа',
            'type_payment' => 'Тип платежа',
            'amount' => 'Сумма',
            'spstatus' => 'Статус',
            'user_id' => 'Пользователь',
            'crmid' => 'CRMID'
        ],
    ],

    'trips' => [
        'name' => 'Поездки',
        'index_title' => 'Список поездок',
        'new_title' => 'Новая поездка',
        'create_title' => 'Создать поездку',
        'edit_title' => 'Отредактировать поездку',
        'show_title' => 'Показать поездку',
        'inputs' => [
            'name' => 'Откуда',
            'where_address' => 'Куда',
            'date' => 'Дата',
            'time' => 'Время',
            'childrens' => 'Количество детей',
            'status' => 'Статус',
            'attendant_id' => 'Сопровождающий',
            'timetable_id' => 'Расписание',
            'scheduled_wait_where' => 'Время ожидания в точке Куда',
            'scheduled_wait_from' => 'Время ожидания в точке Откуда',
            'parking_cost' => 'Стоимость парковки',
        ],
    ],

    'roles' => [
        'name' => 'Роли',
        'index_title' => 'Список ролей',
        'create_title' => 'Создать роль',
        'edit_title' => 'Отредактировать роль',
        'show_title' => 'Показать роль',
        'inputs' => [
            'name' => 'Наименование',
        ],
    ],

    'permissions' => [
        'name' => 'Права доступа',
        'index_title' => 'Список прав доступа',
        'create_title' => 'Создать право доступа',
        'edit_title' => 'Редактировать право доступа',
        'show_title' => 'Показать право доступа',
        'inputs' => [
            'name' => 'Наименование',
        ],
    ],
];
