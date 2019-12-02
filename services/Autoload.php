<?php


class Autoload
{
private $dir = [
    'modules',
    'services'
];

public  function loadClass($className){
    foreach ($this->dir as $dir){
        $file = dirname(__DIR__).'/'.$dir.'/'.$className.'.php';
        if(file_exists($file)){
            include $file;
            return;
        }
    }
}
}