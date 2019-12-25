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
    ],
];
