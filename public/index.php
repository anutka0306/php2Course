<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;

include dirname(__DIR__).'/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);


//$db = new App\services\DB();

$good = new Good();
$good ->id = '12';
$good ->name = 'Test';
$good->description = 'tra-la-la';
$good->category = '1';
$good->image = 'jkjkjkjk';
$good->price='2000';
$good->views_count='0';

//Insert Test
//$good->insert();

$user = new User();
$order = new Orders();
$good->calcRows();
//var_dump($good->getAll());
//var_dump($user->getOne(4));
//var_dump($user->getAll());
//var_dump($order->getOne(12));
//var_dump($good->getOne(1));
//var_dump($order->getAll());
//var_dump($order->getTableName());
//var_dump($order->insert());

