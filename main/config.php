<?php

return [
    'name' => 'My Shop',
    'defaultController' => 'user',

    'components' => [
        'db' => [
          'class' => \App\services\DB::class,
           'config' => [
               'driver'=>'mysql',
               'host'=>'localhost',
               'db'=>'catalogl6',
               'charset'=>'UTF8',
               'username'=>'root',
               'password'=>'root'
           ],
        ],
        'render' => [
          'class' => \App\services\renders\TwigRender::class,
        ],

        'userRepository' => [
          'class' => \App\repositories\UserRepository::class,
        ],

        'userService' => [
            'class' => \App\services\UserService::class,
        ],

        'goodRepository' => [
            'class' => \App\repositories\GoodRepository::class,
        ],

        'goodService' => [
            'class' => \App\services\GoodService::class,
        ],

        'orderRepository' => [
            'class' => \App\repositories\OrderRepository::class,
        ],

        'orderService' => [
            'class' => \App\services\OrderService::class,
        ],

        'authRepository' => [
            'class' => \App\repositories\AuthRepository::class,
        ],

        'authService' => [
            'class' => \App\services\AuthService::class,
        ],
    ],
];
