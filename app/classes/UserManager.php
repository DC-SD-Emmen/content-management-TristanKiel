<?php


    class UserManager {

        private $conn;
        // functie construct wordt automatisch uitgevoerd
        public function __construct($db){ 
            $this->conn = $db;   
        }
        // selectAll haalt alle data van alle users op
        public function selectAll(){
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
        // insertUser haalt stuurt één user naar de database
        public function insertUser($user, $password) {
            //regex controle en specialchars

            $username = htmlspecialchars($user);

            $usernameregex = '/[A-Z][a-z]*/';

            if (!preg_match($usernameregex, $username)) {
                echo("Je hebt geen geldige username ingevuld");
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
        // haalt data van één gebruiker op
        public function getUser($username){

            $stmt = $this->conn->prepare ("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array

            return $user ?: null; // Return null if no user found
            
        }
        // deleteUsers verwijdert een gebruiker
        public function deleteUsers($id){
            $stmt = $this->conn->prepare("DELETE FROM user_games WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $id);
            $stmt->execute();
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        // addToWishList zorgt dat je games naar jouw wishlist kan sturen
        public function addToWishList($user_id, $game_id) {

            try {
                $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':game_id', $game_id);
                $stmt->execute();

                echo "Game is succesvol toegevoegd aan wishlist!";
            }   
            catch (PDOException $e) {
                echo $e->getMessage();
            }

        }
    }
?>