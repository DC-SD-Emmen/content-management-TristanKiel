<?php


class UserManager() {

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


    public function insertUser() {
        

        //regex controle doen
        //htmlspecials eventueel toepassen waar nodig

        //password hashing om het wachtwoord eerst te hashen voordat je hem naar de database stuurt


        //en dan met mysql de boel naar de database sturen

        $stmt = $conn->prepare("INSERT INTO users (username, password)");
        $stmt->bindparam($username);
        $stmt->bindparam($password);
        $stmt->execute();

        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);

        $usernameregex = '/?([A-Z]*[a-z]*[0-9]*)/';
        $passwordregex = '/?([A-Z]*[a-z]*[0-9]*)/';

        if (!preg_match($usernameregex, $username)) {
            echo("error");
        }

        if (!preg_match($passwordregex, $password)) {
            echo("error");
        }

        $hashedPassword = password_hash($password);

        $stmt = $this->conn->prepare("INSERT INTO users (username, password");
        $UserManager->setUserName($username);
        $UserManager->setPassword($password);
        $stmt->execute();
    }

}

?>