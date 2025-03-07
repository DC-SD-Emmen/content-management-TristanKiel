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

    


    public function insertUser($user, $password) {
        //regex controle doen
        //htmlspecials eventueel toepassen waar nodig
        $username = htmlspecialchars($user);

        $usernameregex = '/[A-Z][a-z]*/';

        if (!preg_match($usernameregex, $username)) {
            echo("error");
        }

        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            header('Location: inlog.php');
        }   
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function getUser($username){

        $stmt = $this->conn->prepare ("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array

        return $user ?: null; // Return null if no user found
        
    }

}

?>