<?php


namespace App\services;


use App\entities\User;
use App\repositories\UserRepository;

class UserService
{
    public function fillUser($params)
    {
        if($this->hasErrors($params)){
            return [
              'msg'=>'Нет данных',
              'success'=> false,
            ];
        }
        $user = new User();
        $user->login = $params['login'];
        $user->name = $params['name'];
        $user->role = $params['role'];
        $user->tel = $params['tel'];
        $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        (new UserRepository())->save($user);
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