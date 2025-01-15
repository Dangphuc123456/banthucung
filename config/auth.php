<?php

return [
    'defaults' => [
        'guard' => 'web', // Guard mặc định là 'web'
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],


        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class,  // Đảm bảo model đúng
        ],

        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [ // Khôi phục mật khẩu cho admin
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
