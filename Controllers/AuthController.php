<?php


namespace App\Controllers;


class AuthController extends Controller
{
    protected $defaultAction = 'login';
    public function loginAction()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_SESSION['role'] = 1;
            return header('Location: /php2Course/lesson5/php2Course/public/admin');
        }
       return $this->render->render('login');
    }
    public function logoutAction()
    {

    }
}