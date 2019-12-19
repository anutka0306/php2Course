<?php


namespace App\Controllers;


use App\modules\User;
use App\services\renders\IRender;
use App\services\renders\TwigRender;

abstract class Controller
{
    protected $defaultAction = 'all';
    protected $render;

    public function __construct(IRender $render)
    {
        $this->render = $render;
    }

    public function run($action){
        if(empty($action)){
            $action = $this->defaultAction;
        }
        $method = $action .'Action';
        if(method_exists($this, $method)){
            return $this->$method();
        }
        return '404';
    }

    protected function render($template, $params = []){
        return $this->render->render($template, $params);
    }

}