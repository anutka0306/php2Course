<?php


namespace App\repositories;


use App\entities\Good;

class GoodRepository extends Repository
{
    public function getTableName(): string
    {
        return 'goods';
    }

    public function getEntityClass(): string
    {
        return Good::class;
    }
}