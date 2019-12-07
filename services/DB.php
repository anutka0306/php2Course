<?php
namespace App\services;

class DB implements IDB
{
    use TCalcRows;
    public function find(string $sql){
        return $sql . " findOne";
    }

    public function findAll(string $sql)
    {
        return $sql . " findAll";
    }

    public function insert(string $sql){
        return $sql ." Insert";
    }
}