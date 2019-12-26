<?php


namespace App\repositories;


use App\entities\Auth;

class AuthRepository extends Repository
{
    public function getTableName(): string
    {
        return 'users';
    }

    public function getEntityClass(): string
    {
        return Auth::class;
    }

    public function verificateUser($login, $password){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE login= :login AND password= :password";
        return $this->db->queryObject($sql, $this->getEntityClass(), [':login' => $login, ':password'=>$password]);

    }
}