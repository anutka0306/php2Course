<?php


namespace App\repositories;


use App\entities\Entity;
use App\entities\Order;
use App\main\App;


class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return 'orders';
    }
    public function getSubTableName(): string
    {
        return 'orderlist';
    }

    public function getEntityClass(): string
    {
        return Order::class;
    }

    public function getInsertedId(){
        return $this->db->lastInsertId();
    }

    public function insertSub(Entity $entity){
        $tableName = $this->getSubTableName();
        $data = [];
        $columns =[];
        $params =[];
        foreach ($entity as $property => $value){
            if($property == 'id'){
                continue;
            }
            $data[$property] = $value;
        }
        foreach ($data as $property => $value){
            $columns[] = $property;
            $params[":{$property}"] = $value;
        }
        $columnString = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));
        $sql = "INSERT INTO $tableName($columnString) VALUES($placeholders)";
        $this->db->exec($sql, $params);
        $entity->id = $this->db->lastInsertId();
    }
}