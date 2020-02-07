<?php


namespace App\Controllers;


class Admin extends Controller
{
    public function run($action){
        if(empty($_SESSION['role'])){
            return header('Location:/php2Course/lesson5/php2Course/public/auth/');
        }

        return parent::run($action);
    }
}