<?php


namespace App\Controllers;


use App\modules\User;

class UserController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){
        $users = (new User())->getAll();
        return $this->render('users', ['users'=>$users]);
    }

    public function oneAction(){
        $oUser = new User();
        $user = $oUser->getOne($_GET['id']);
        return $this->render('user', ['user' => $user]);
    }

}