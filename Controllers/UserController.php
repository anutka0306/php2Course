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

    public function addAction(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user = new User();
            $user->login = $_POST['login'];
            $user->name = $_POST['name'];
            $user->role = $_POST['role'];
            $user->tel = $_POST['tel'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->save();
            return header('Location: ?c=user');
        }
        return $this->render('userAdd');
    }

}