<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;
use App\services\renders\TmplRender;
use App\services\renders\TwigRender;

include dirname(__DIR__).'/vendor/autoload.php';

new \Twig\Loader\FilesystemLoader();

isset($_GET['c']) ? $controllerName =  $_GET['c'] : $controllerName = 'user';
$actionName = '';
if(!empty($_GET['a'])){
    $actionName = $_GET['a'];
}
$controllerClass = 'App\\Controllers\\'. ucfirst($controllerName).'Controller';

if(class_exists($controllerClass)){
    $controller = new $controllerClass(new TwigRender());
    echo $controller->run($actionName);
}
