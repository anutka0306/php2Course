<?php


namespace App\Controllers;


use App\main\App;

class OrderController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){
       $goods = $this->request->session('goods');
       var_dump($goods);
        return $this->render('cart', [
            'goods'=> $goods,
            'title'=>'Товары в корзине'
        ]);

    }

    public function oneAction(){
       /* return $this->render('good', [
            'good' => App::call()->goodRepository->getOne($this->getId()),
            'title'=>'Один товар'
        ]);*/
    }

    public function addAction()
    {
        $id = $this->getId();
        $inCart = $this->request->get('inCart');
        App::call()->orderService->fillSession($id, App::call()->goodRepository->getOne($id), 'add');
        if(!$inCart) {
            return header('Location:/php2Course/lesson5/php2Course/public/good/');
        }else{
            return header('Location:/php2Course/lesson5/php2Course/public/order/');
        }
    }

    public function deleteAction(){
        if(empty($this->getId())){
            return header('Location: /php2Course/lesson5/php2Course/public/order/');
        }
        $id = $this->getId();
        App::call()->orderService->fillSession($id, App::call()->goodRepository->getOne($id), 'del');
        return header('Location:/php2Course/lesson5/php2Course/public/order/');
    }

    public function checkoutAction(){
      if(!($this->request->session('role'))){
          return header('Location:/php2Course/lesson5/php2Course/public/admin/');
      }
      $userId = $this->request->session('authUser')->id;
      $goods = $this->request->session('goods');
        App::call()->orderService->fillOrder($userId, $goods);
    }
}