<?php

class Database() {

    private $servername = "mysql";
    private $username = "root";
    private $password = "root";
    private $conn;

    public function __construct() {

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=myDB", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

    }

    public function getConnection() {
        return $this->conn;
    }



}


?>