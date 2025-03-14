<?php

    class Koppeltabel {

        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function insert(){
            $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id)");
            $stmt->execute();
        }

        public function selectGames($user_id){
            $stmt = $this->conn->prepare("SELECT games.image
                                        FROM games
                                        INNER JOIN user_games ON games.id = user_games.game_id
                                        WHERE user_games.user_id = :user_id;");
            $stmt->bindParam(':user_id', $user_id);
                                    
            $stmt->execute();
            $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultaten = $stmt->fetchALl();
            return $resultaten;
        }

        public function selectUsers($game_id){
            $stmt = $this->conn->prepare("SELECT user.username
                                        FROM games
                                        INNER JOIN user_games ON user.id = user_games.user_id
                                        WHERE user_games.game_id = :game_id;");
            $stmt->bindparam(':game_id', $game_id);

            $stmt->execute();
            $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultaten = $stmt->fetchALl();
            return $resultaten;
        }
    }

?>