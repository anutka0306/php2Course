<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;

include dirname(__DIR__).'/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);


//$db = new App\services\DB();

$good = new Good();
$good ->name = 'XXXXXX56565';
$good->description = 'Test Description 1';
$good->category = '2';
$good->image = 'picture 1';
$good->price='22222';


$user = new User();
$user->name='XXXXXXX2';
$user->role = '1';
$user->tel = '89667554541';
$user->login = 'TestLogin1';
$user->password='123451';

//Delete Test

/*$good2 = (new Orders())->getOne(16);
var_dump($good2);
$good2->delete();*/


//$user->save();

//Save test
//$good->save(8);
//$good->save();
//$user->save();


$order = new Orders();
//$good->calcRows();
//var_dump($good->getAll());
//var_dump($user->getOne(4));
//var_dump($user->getAll());
//var_dump($order->getOne(12));
//var_dump($good->getOne(1));
//var_dump($order->getAll());
//var_dump($order->getTableName());
//var_dump($order->insert());

