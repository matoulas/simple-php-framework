<?php
    session_start();
    set_include_path("." . PATH_SEPARATOR . realpath(__DIR__."/../"));
    spl_autoload_extensions('.php');
    spl_autoload_register(function($class){
        if(!strstr($class, "\\")){
            return;
        }
        $file = str_replace('\\', '/', $class);
        if (file_exists(stream_resolve_include_path("$file.php"))) {
            require_once "{$file}.php";
        } else {
            die ("Class $file does not exists");
        }
    });
    
    $SimpleFramework = new Api\App\SimpleFramework();
    $SimpleFramework->startApp();
