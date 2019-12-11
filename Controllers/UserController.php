<?php


namespace App\Controllers;


class UserController
{
    protected $defaultAction = 'all';

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

    public function allAction(){
        return 'All Users';
    }

    public function oneAction(){
        return 'One User';
    }
}