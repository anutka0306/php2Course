<?php
use App\modules\Good;
use App\modules\User;
use App\modules\Orders;
use App\services\renders\TmplRender;
use App\services\renders\TwigRender;

include dirname(__DIR__).'/vendor/autoload.php';

$request = new \App\services\Request();
new \Twig\Loader\FilesystemLoader();

$controllerName =  $request->getControllerName() ?: $controllerName = 'user';
$actionName = $request->getActionName();
$controllerClass = 'App\\Controllers\\'. ucfirst($controllerName).'Controller';

if(class_exists($controllerClass)){
    $controller = new $controllerClass(new TwigRender(), $request);
    echo $controller->run($actionName);
}
