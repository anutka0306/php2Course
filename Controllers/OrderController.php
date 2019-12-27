<?php


namespace App\Controllers;


use App\main\App;

class OrderController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){
       $goods = $this->request->session('goods');
        return $this->render('cart', [
            'goods'=> $goods,
            'title'=>'Товары в корзине'
        ]);

    }

    public function myordersAction(){
        $userId = $this->request->session('authUser')->id;
        return $this->render('myOrders', [
            'myOrders' => App::call()->orderRepository->getMyOrders($userId),
            'title' => 'Все Заказы'
        ]);
    }

    public function myorderAction(){
        $orderId = $this->request->get('id');
        return $this->render('myOrder', [
            'myOrder' => App::call()->orderRepository->getMyOrder($orderId),
            'title' => 'Один заказ'
        ]);
    }

    public function allordersAction(){
        return $this->render('admin/allOrders', [
            'orders' => App::call()->orderRepository->getAllOrders(),
            'title' => 'Все заказы - Администратор'
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
        $inCard = $this->request->get('inCard');
        App::call()->orderService->fillSession($id, App::call()->goodRepository->getOne($id), 'add');
        if($inCart) {
            return header('Location:/php2Course/lesson5/php2Course/public/order/');
        }
        elseif ($inCard){
            return header('Location:/php2Course/lesson5/php2Course/public/good/one?id='.$id);
        }
        else{
            return header('Location:/php2Course/lesson5/php2Course/public/');

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