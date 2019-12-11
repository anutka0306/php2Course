<?php


namespace App\Controllers;


use App\modules\User;

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
        $users = (new User())->getAll();
        return $this->renderTmpl('users', ['users'=>$users]);
    }

    public function oneAction(){
        return 'One User';
    }

    /**
     * @param $template
     * @param array $params ["users"=>123, "tr"=>[1,5,6]]
     * @return false|string;
     */
    public function renderTmpl($template, $params = []){
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}