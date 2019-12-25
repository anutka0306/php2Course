<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;
use App\services\renders\TmplRender;
use App\services\renders\TwigRender;

session_start();
include dirname(__DIR__).'/vendor/autoload.php';
$config = include dirname(__DIR__).'/main/config.php';

(new \App\main\App())->run($config);


