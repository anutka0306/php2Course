<?php


namespace App\Controllers;


use App\main\App;
use App\modules\User;
use App\repositories\UserRepository;
use App\services\UserService;

class UserController extends Controller
{
    protected $defaultAction = 'all';
    protected $defaultRole = 0;

    public function allAction(){
        if(empty($this->request->session('authUser')->role)){
            $role = 0;
        }
        else{
            $role = $this->request->session('authUser')->role;
        }
       if($role == 2){
           return $this->render('users', [
               'users'=>App::call()->userRepository->getAll(),
               'title'=>'Все пользователи'
           ]);
       }else{
           echo "Доступ закрыт";
       }

    }

        public function oneAction(){

        return $this->render('user', [
            'user' => App::call()->userRepository->getOne($this->getId()),
            'title'=>'Один пользователь'
        ]);
    }

    public function addAction(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            App::call()->userService->fillUser($this->request->post());
            return header('Location: /php2Course/lesson5/php2Course/public/user/');
        }
        return $this->render('userAdd');
    }

    public function updateAction(){
    if(empty($this->getId())){
        return header('Location: /php2Course/lesson5/php2Course/public/user/');
    }
    $user = App::call()->userRepository->getOne($this->getId());

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        App::call()->userService->fillUser($this->request->post(), $user);
        return header('Location: /php2Course/lesson5/php2Course/public/user/');
    }
    return $this->render('userUpdate', ['user' => $user]);
}

    public function deleteAction(){
        if(empty($this->getId())){
            return header('Location: /php2Course/lesson5/php2Course/public/user/');
        }
        $user = App::call()->userRepository->getOne($this->getId());
        App::call()->userRepository->delete($user->id);
        return header('Location: /php2Course/lesson5/php2Course/public/user/');
    }

}