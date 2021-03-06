<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'middle_name' => 'Middle Name',
            'phone' => 'Phone',
            'attendant_gender' => 'Attendant Gender',
            'otherphone' => 'Otherphone',
            'imagename' => 'Imagename',
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
            'scheduled_wait_from' => 'Scheduled Wait From',
            'parking_cost' => 'Parking Cost',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
