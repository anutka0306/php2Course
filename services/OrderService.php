<?php


namespace App\services;


use App\entities\Good;
use App\main\App;

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