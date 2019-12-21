<?php


namespace App\Controllers;


use App\modules\User;

class UserController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){
        $users = (new User())->getAll();
        return $this->render('users', [
            'users'=>$users,
            'title'=>'Все пользователи'
        ]);
    }

    public function oneAction(){
        $oUser = new User();
        $id = $this->request->get('id');
        $user = $oUser->getOne($id);
        return $this->render('user', [
            'user' => $user,
            'title'=>'Один пользователь'
        ]);
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

    public function updateAction(){
        if(empty($_GET['id'])){
            return header('Location: ?c=user');
        }
        $user = (new User())->getOne($_GET['id']);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user->id = $_POST['id'];
            $user->login = $_POST['login'];
            $user->name = $_POST['name'];
            $user->role = $_POST['role'];
            $user->tel = $_POST['tel'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->save($user->id);
            return header('Location: /php2Course/lesson5/php2Course/public/user/');
        }
        return $this->render('userUpdate', ['user' => $user]);
    }

}