<?php


class UserManager {

    private $conn;

    public function __construct($db){ 
        $this->conn = $db;   
    }

    public function select(){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users");
            $stmt->execute();
            $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultaten = $stmt->fetchALl();
            return $resultaten;
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resultaten = [];
        }
    }

    public function selectUser(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=$username")
            $stmt->execute();
            $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $resultaten;
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resultaten = [];
        }
    }


    public function insertUser($user, $password) {
        

        //regex controle doen
        //htmlspecials eventueel toepassen waar nodig
        $username = htmlspecialchars($user);

        $usernameregex = '/[A-Z][a-z]*/';

        // $passwordregex = '/?([A-Z]*[a-z]*[0-9]*)/';

        if (!preg_match($usernameregex, $username)) {
            echo("error");
        }

        // if (!preg_match($passwordregex, $password)) {
        //     echo("error");
        // }

        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            echo "New data created successfully";
        }   
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>