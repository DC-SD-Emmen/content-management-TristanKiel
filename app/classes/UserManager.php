<?php


class UserManager() {

    private $conn;

    public function __construct($db){ 
        $this->conn = $db;   
    }


    public function insertUser() {
        

        //regex controle doen
        //htmlspecials eventueel toepassen waar nodig

        //password hashing om het wachtwoord eerst te hashen voordat je hem naar de database stuurt


        //en dan met mysql de boel naar de database sturen

        $stmt = $conn->prepare("INSERT INTO users (id, username, password)");
        $stmt->bindparam($id);
        $stmt->bindparam($username);
        $stmt->bindparam($password);
    }

}

?>