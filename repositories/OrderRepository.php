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

    public function getMyOrders($id){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE user_id = :user_id";
        return $this->db->queryObjects($sql, $this->getEntityClass(), [':user_id' => $id]);
    }

    public function getMyOrder($id){
        $tableName = $this->getSubTableName();
        $sql  = "SELECT orderlist.good_id, orderlist.quantity, goods.name, goods.description, goods.image, goods.price FROM {$tableName} LEFT JOIN goods ON goods.id = orderlist.good_id WHERE orderlist.order_id = :order_id";
        return $this->db->queryObjects($sql, $this->getEntityClass(), [':order_id' => $id]);
    }

    public function getAllOrders(){
        $tableName = $this->getTableName();
        $sql = "SELECT orders.id AS orderId, orders.status_id, users.id AS userId, users.name, users.tel, users.login, statuslist.status_name FROM {$tableName} LEFT JOIN users ON orders.user_id = users.id LEFT JOIN statuslist ON statuslist.status_id = orders.status_id ";
        return $this->db->queryObjects($sql, $this->getEntityClass());
    }
}