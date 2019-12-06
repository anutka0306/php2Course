<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;

include dirname(__DIR__).'/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);


$db = new App\services\DB();

$good = new Good($db);
$user = new User($db);
$order = new Orders($db);
$good->calcRows();
var_dump($good->getOne(12));
var_dump($good->getAll());
var_dump($user->getOne(12));
var_dump($user->getAll());
var_dump($order->getOne(12));
var_dump($order->getAll());
var_dump($order->getTableName());
var_dump($order->insert());

