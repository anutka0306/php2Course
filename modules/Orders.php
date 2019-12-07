<?php
namespace App\modules;

class Orders extends Model
{
    public function getTableName(): string
    {
        // TODO: Implement getTableName() method.
        return 'orders';
    }

    public function getOne($id){
        $tableName = $this->getTableName();
        $sql = "SELECT goods.good_id, goods.name, goods.price, orderlist.quantity, orderlist.order_id, orders.status_id FROM goods LEFT JOIN orderlist ON goods.good_id=orderlist.good_id LEFT JOIN {$tableName} ON orders.order_id=orderlist.order_id WHERE orderlist.order_id = :id";
        return $this->db->findAll($sql, [':id' => $id]);
    }
}