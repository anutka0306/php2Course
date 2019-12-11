<?php


namespace App\Controllers;


class UserController
{
    protected $defaultAction = 'all';
    public function run($action){
        echo $action;
    }
}