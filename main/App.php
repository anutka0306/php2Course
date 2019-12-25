<?php


namespace App\main;
use App\services\renders\TwigRender;


class App
{
    public $config = [];
    private $components = [];

    public function run(array $config)
    {
        $this->config = $config;
        $this->runController();
    }

    protected  function runController(){
        $request = new \App\services\Request();
        new \Twig\Loader\FilesystemLoader();

        $controllerName =  $request->getControllerName() ?: $controllerName = 'user';
        $actionName = $request->getActionName();
        $controllerClass = 'App\\Controllers\\'. ucfirst($controllerName).'Controller';

        if(class_exists($controllerClass)){
            $controller = new $controllerClass(new TwigRender(), $request);
            echo $controller->run($actionName);
        }
    }

}