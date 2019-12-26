<?php


namespace App\Controllers;


use App\main\App;

class AuthController extends Controller
{
    protected $defaultAction = 'login';
    public function loginAction()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $verificationStatus = App::call()->authService->verifUser($this->request->post());
            if($verificationStatus['success']){
                $_SESSION['role'] = 1;
                $role=$verificationStatus['role'];
                if($role == 2) {
                    return $this->render->render('admin/adminIndex');
                }else{
                    return header('Location: /php2Course/lesson5/php2Course/public/admin');
                }
            }else{
                echo $verificationStatus['msg'];
                return $this->render->render('login');
            }
        }
        return $this->render->render('login');
    }
    public function logoutAction()
    {
        unset($_SESSION['authUser']);
        unset($_SESSION['role']);
        return header('Location: /php2Course/lesson5/php2Course/public/');
    }
}