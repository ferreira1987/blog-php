<?php

class Conexao{

    private static $host = 'localhost';
    private static $database = 'blog';
    private static $username = 'root';
    private static $password = '';
    public static $instance;

    
    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$database, self::$username, self::$password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }


}



