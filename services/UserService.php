<?php


namespace App\services;


use App\entities\User;
use App\main\App;

class UserService
{
    public function fillUser($params, $user = null)
    {
        if($this->hasErrors($params)){
            return [
              'msg'=>'Нет данных',
              'success'=> false,
            ];
        }

        if(empty($user)){
            $user = new User();
        }

        $user->login = $params['login'];
        $user->name = $params['name'];
        $user->role = $params['role'];
        $user->tel = $params['tel'];
        $user->password = md5($params['password']);
        App::call()->userRepository->save($user);
        return [
            'msg'=>'Пользователь сохранен',
            'success'=> true,
        ];
    }

    protected function hasErrors($params)
    {
       if(empty($params['login']) || empty($params['name']) || empty($params['role']) || empty($params['tel']) || empty($params['password'])){
          return true;
       }
       return false;
    }
}