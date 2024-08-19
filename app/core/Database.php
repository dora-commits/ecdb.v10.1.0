<?php

/**
 * Trait Database
 */
Trait  Database
{
    public function connect()
    {
        $host = $_ENV['DB_SERVER'];
        $port = $_ENV['DB_PORT'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        $dsn = "mysql:hostname=".$host.";port=".$port.";dbname=".$name."";
        $con = new PDO($dsn, $user, $pass);
        return $con;
    }
}