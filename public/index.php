<?php
include dirname(__DIR__).'/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);


$db = new App\services\DB();

$good = new App\modules\Good($db);
$user = new App\modules\User($db);
$order = new App\modules\Orders($db);
var_dump($good->getOne(12));
var_dump($good->getAll());
var_dump($user->getOne(12));
var_dump($user->getAll());
var_dump($order->getOne(12));
var_dump($order->getAll());

