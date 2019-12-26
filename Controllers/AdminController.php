<?php


namespace App\Controllers;


class AdminController extends Admin
{
    protected $defaultAction = 'index';

    public function indexAction()
    {
        if(empty($this->request->session('authUser')->role)){
            $role = 0;
        }
        else{
            $role = $this->request->session('authUser')->role;
        }
        if($role == 2) {
            return $this->render->render('admin/adminIndex');
        }else{
            return $this->render->render('admin/index');
        }
    }
}