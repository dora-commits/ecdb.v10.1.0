<?php

class  Database
{
    public function connect()
    {
        show($_ENV['DB_SERVER']);
        $host = $_ENV['DB_SERVER'];
        $port = $_ENV['DB_PORT'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        $dsn = "mysql:hostname=".$host.";port=".$port.";dbname=".$name."";
        $con = new PDO($dsn, $user, $pass);
        try {
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        
        // return $con;
    }
}