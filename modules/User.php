<?php
namespace App\modules;

class User extends Model
{
    public $id;
    public $role;
    public $name;
    public $tel;
    public $login;
    public $password;

    public function getTableName(): string
    {
        // TODO: Implement getTableName() method.
        return 'users';
    }
}