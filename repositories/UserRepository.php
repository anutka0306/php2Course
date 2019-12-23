<?php


namespace App\repositories;


use App\entities\User;

class UserRepository extends Repository
{
    public function getTableName(): string
    {
        return 'users';
    }

    public function getEntityClass(): string
    {
        return User::class;
    }
}