<?php


namespace App\Controllers;


class AdminController extends Controller
{
    protected $defaultAction = 'index';

    public function indexAction()
    {
        if(empty($_SESSION['role'])){
            return header('Location:/php2Course/lesson5/php2Course/public/auth/');
        }
         return $this->render->render('admin/index');
    }
}