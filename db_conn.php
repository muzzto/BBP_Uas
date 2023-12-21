<?php

class DBConnection {
    private $conn;

    public function __construct($sName, $uName, $pass, $db_name) {
        try {
            $this->conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$dbConfig = array(
    'sName' => 'localhost',
    'uName' => 'root',
    'pass' => '',
    'db_name' => 'to_do_list'
);

$dbConnection = new DBConnection($dbConfig['sName'], $dbConfig['uName'], $dbConfig['pass'], $dbConfig['db_name']);
$conn = $dbConnection->getConnection();

