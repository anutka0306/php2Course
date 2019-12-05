<?php
namespace App\modules;

class User extends Model
{
    public function getTableName(): string
    {
        // TODO: Implement getTableName() method.
        return 'users';
    }
}