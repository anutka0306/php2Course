<?php


namespace App\Controllers;


class AdminController extends Admin
{
    protected $defaultAction = 'index';

    public function indexAction()
    {

         return $this->render->render('admin/index');
    }
}