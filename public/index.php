<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;


include dirname(__DIR__).'/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);

isset($_GET['c']) ? $controllerName =  $_GET['c'] : $controllerName = 'user';
$actionName = '';
if(!empty($_GET['a'])){
    $actionName = $_GET['a'];
}
$controllerClass = 'App\\Controllers\\'. ucfirst($controllerName).'Controller';

if(class_exists($controllerClass)){
    $controller = new $controllerClass;
    echo $controller->run($actionName);
}
