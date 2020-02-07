<?php


namespace App\traits;


trait TSingleton
{
    protected function __construct(){}
    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }
    protected function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    private static $items;

    public static function getInstance(){
        if(empty(static::$items)){
            static::$items = new static();
        }
        return static::$items;
    }
}