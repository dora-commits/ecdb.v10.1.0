<?php

spl_autoload_register(function($class_name) {
    $directories = [
        '../app/models/',
        '../app/middleware/',
    ];

    foreach ($directories as $directory) {
        $filename = $directory . ucfirst($class_name) . ".php";
        if (file_exists($filename)) {
            require $filename;
            return; // Stop further searching once the class is found
        }
    }
});


require_once __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load(); 

require 'function.php';
require 'Route.php';
require 'Controller.php';
require 'Database.php';
require 'Model.php';