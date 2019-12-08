<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;

include dirname(__DIR__).'/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);


//$db = new App\services\DB();

$good = new Good();
$good ->name = 'Nice Dress';
$good->description = 'Test Description';
$good->category = '2';
$good->image = 'picture';
$good->price='2100';


//Insert Test
//$good->insert();

$user = new User();
$user->name='InsertTest';
$user->role = '1';
$user->tel = '8966755454';
$user->login = 'TestLogin';
$user->password='12345';

//Insert Test
//$user->insert();

//Update Test
//$user->update(2);
//$good->update(4);

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

