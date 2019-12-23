<?php


namespace App\Controllers;


use App\modules\User;
use App\repositories\UserRepository;
use App\services\UserService;

class UserController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){

        return $this->render('users', [
            'users'=>(new UserRepository())->getAll(),
            'title'=>'Все пользователи'
        ]);
    }

    public function oneAction(){

        return $this->render('user', [
            'user' => (new UserRepository())->getOne($this->getId()),
            'title'=>'Один пользователь'
        ]);
    }

    public function addAction(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            (new UserService())->fillUser($this->request->post());
            return header('Location: /php2Course/lesson5/php2Course/public/user/');
        }
        return $this->render('userAdd');
    }

    public function updateAction(){
    if(empty($this->getId())){
        return header('Location: /php2Course/lesson5/php2Course/public/user/');
    }
    $user = (new User())->getOne($this->getId());

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

    public function deleteAction(){
        if(empty($this->getId())){
            return header('Location: /php2Course/lesson5/php2Course/public/user/');
        }
        $user = (new User())->getOne($this->getId());
        $user->delete($user->id);
        return header('Location: /php2Course/lesson5/php2Course/public/user/');
    }

}