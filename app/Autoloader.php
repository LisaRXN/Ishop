<?php

spl_autoload_register(function($class_name){
    $file = __DIR__ .'/'. $class_name .'.class.php';
    if(file_exists($file)){
        require_once $file;
    }else{
        echo "File for classe {$class_name} not found.\n";
    }  
});
