<?php


namespace App\repositories;


use App\entities\Order;


class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return 'orders';
    }

    public function getEntityClass(): string
    {
        return Order::class;
    }

    public function getCartAll($cart = null)
    {
        if(!empty($cart)){
           // var_dump($cart);
            return $cart;
        }
        else{
            echo "Корзина Пуста";
        }
    }
}