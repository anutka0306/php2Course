<?php

class Autoload
{
private $dir = [
    'modules',
    'services'
];

public  function loadClass($className){
    foreach ($this->dir as $dir){
        $className = str_replace('\\','/', $className);
        $className = substr($className, 3);
        $file = dirname(__DIR__).$className.'.php';
       //var_dump($file);
        if(file_exists($file)){
            include $file;
            return;
        }
    }
}
}