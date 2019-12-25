<?php


namespace App\services;


use App\entities\Good;
use App\main\App;

class GoodService
{
    public function fillGood($params, $image, $good = null)
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
    }
}