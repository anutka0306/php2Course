<?php
namespace App\services;
interface IDB
{
    /**
     *
     * @param string $sql
     * @return mixed
     */
    public function find(string $sql, array $params);

    /**
     * @param string $sql
     * @return mixed
     */
    public function findAll(string $sql, array $params);
    public function insert(string $sql, array $params);
}