<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '011110');
define('DB_DATABASE', 'prueba');

function db_connect(){
    try{
        $conn = new PDO("mysql:host=". DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        return $conn;
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}