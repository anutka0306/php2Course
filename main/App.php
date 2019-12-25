<?php
/**
 * Class App
 * @package App\main
 * @property IRender render
 * @property DB db
 * @property UserRepository userRepository
 * @property UserService userService
 */

namespace App\main;

use App\services\renders\TwigRender;
use App\services\renders\IRender;
use App\traits\TSingleton;

class App
{
    use TSingleton;
    static public function call() : App
    {
        return static :: getInstance();
    }

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

    public function __get($name)
    {
        if(array_key_exists($name, $this->components))
        {
            return $this->components[$name];
        }
        if(!array_key_exists($name, $this->config['components']))
        {
            return null;
        }

        $className = $this->config['components'][$name]['class'];
        if(array_key_exists('config', $this->config['components'][$name]))
        {
            $config = $this->config['components'][$name]['config'];
            $components = new $className($config);
        }else{
            $components = new $className();
        }
        $this->components[$name] = $components;
        return $components;
    }

}