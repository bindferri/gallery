<?php

function autoLoader($class){
    $path = 'classes/'.$class.'.php';

    if (file_exists($path)){
        require_once $path;
    }elseif (file_exists("../".$path)){
        require_once "../".$path;
    }
    else{
        die('your path is wrong');
    }
}

spl_autoload_register('autoLoader');