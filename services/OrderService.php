<?php


namespace App\services;


use App\entities\Good;
use App\entities\Order;
use App\entities\OrderList;
use App\main\App;
use App\services\DB;

class OrderService
{
    public function fillSession($id = null, $obj = null, $act)
    {
        if($act == 'add') {
            if (isset($_SESSION['goods'][$id])) {
                $_SESSION['goods'][$id]['quantity'] += 1;
            } else {
                $_SESSION['goods'][$id]['good'] = $obj;
                $_SESSION['goods'][$id]['quantity'] = 1;
            }
        }
        elseif ($act == 'del'){
            if ($_SESSION['goods'][$id]['quantity'] == 1) {
                unset($_SESSION['goods'][$id]);
            } else {
                $_SESSION['goods'][$id]['quantity'] -= 1;
            }
        }
    }

    public function fillOrder($userId, $goods, $order = null)
    {
        if(empty($order)){
            $order = new Order();
            $order->status_id = 0;
        }
        $order->user_id = $userId;
        App::call()->orderRepository->save($order);
       $order_id = App::call()->orderRepository->getInsertedId();

       $orderList = new OrderList();
       foreach ($goods as $good){
           $orderList->order_id = $order_id;
           $orderList->good_id = $good['good']->id;
           $orderList->quantity = $good['quantity'];
           App::call()->orderRepository->insertSub($orderList);
       }
        unset($_SESSION['goods']);
        return [
            'msg'=>'Заказ сохранен',
            'success'=> true,
        ];

    }
    public function changeStatus($params, $order){
       $order->id = $params['orderId'];
       $order->status_id = $params['status'];
        App::call()->orderRepository->save($order);
        return [
            'msg'=>'Статус изменен',
            'success'=> true,
        ];
    }

    /*public function fillGood($params, $image, $good = null)
    {
        if($this->hasErrors($params)){
            return [
                'msg'=>'Нет данных',
                'success'=> false,
            ];
        }

        if(empty($good)){
            $good = new Good();
        }

        $good->name = $params['name'];
        $good->description = $params['description'];
        $good->category = $params['category'];
        $good->price = $params['price'];
        $good->image = $image;
        App::call()->goodRepository->save($good);
        return [
            'msg'=>'Товар сохранен',
            'success'=> true,
        ];
    }

    protected function hasErrors($params)
    {
        if(empty($params['name']) || empty($params['description']) || empty($params['category']) || empty($params['price']) ){
            return true;
        }
        return false;
    } */
}