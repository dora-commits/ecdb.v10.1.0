<?php

spl_autoload_register(function($class_name){
    require $filename = "../app/models/".ucfirst($class_name).".php";
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