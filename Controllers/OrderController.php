<?php


namespace App\Controllers;


use App\main\App;

class OrderController extends Controller
{
    protected $defaultAction = 'all';


    public function allAction(){
        var_dump($this->request->session('goods'));
        //session_unset();
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
        //$_SESSION['goods'][$id] = App::call()->goodRepository->getOne($id);
        App::call()->orderService->fillSession($id, App::call()->goodRepository->getOne($id));

        return header('Location:/php2Course/lesson5/php2Course/public/good/');
    }
}