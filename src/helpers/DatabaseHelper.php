<?php namespace DatabaseHelper;


require(__DIR__ . '/../config/secret.php');



class DatabaseHelper {

    private $connection;

    function __construct() {
        $databaseInfo = (new \secret())->getDatabaseInfo();
        $connection = new \PDO("mysql:host={$databaseInfo['host']}:{$databaseInfo['port']};dbname={$databaseInfo['database']}", $databaseInfo['user'], $databaseInfo['pass']);
    }

    function getConnection() {
        return $this->connection;
    }

    function query($query) {
        return $this->connection->query($query);
    }
    
    function execute($query) {
        return $this->connection->execute($query);
    }

}