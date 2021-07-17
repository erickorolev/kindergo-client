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
        'name' => 'Children',
        'index_title' => 'Children List',
        'new_title' => 'New Child',
        'create_title' => 'Create Child',
        'edit_title' => 'Edit Child',
        'show_title' => 'Show Child',
        'inputs' => [
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'middle_name' => 'Middle Name',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'otherphone' => 'Otherphone',
            'imagename' => 'Imagename',
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
        'name' => 'Payments',
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
            'user_id' => 'User',
        ],
    ],

    'trips' => [
        'name' => 'Trips',
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
            'timetable_id' => 'Timetable',
            'scheduled_wait_where' => 'Scheduled Wait Where',
            'sheduled_wait_from' => 'Sheduled Wait From',
            'parking_cost' => 'Parking Cost',
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
