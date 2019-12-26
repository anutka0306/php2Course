<?php


namespace App\services;


use App\entities\Auth;
use App\main\App;

class AuthService
{
    public function verifUser($params)
    {
        if($this->hasErrors($params)){
            return [
                'msg'=>'Нет данных',
                'success'=> false,
            ];
        }

        $login = $params['login'];
        $password = md5($params['password']);
        $user = App::call()->authRepository->verificateUser($login, $password);
        $_SESSION['authUser'] = $user;
       if($user) {
           return [
               'msg' => 'Пользователь сохранен',
               'success' => true,
           ];
       }else{
           return [
               'msg'=>'Данные не верны',
               'success'=> false,
           ];
       }
    }

    protected function hasErrors($params)
    {
        if(empty($params['login']) ||  empty($params['password'])){
            return true;
        }
        return false;
    }
}