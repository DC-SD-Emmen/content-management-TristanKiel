<?php

    class Koppeltabel {

        public function insert(){
            $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id)");
            $stmt->execute();
        }

        public function selectGames($user_id){
            $stmt = $this->conn->prepare("SELECT games.title
                                        FROM games
                                        INNER JOIN user_games ON games.id = user_games.game_id
                                        WHERE user_games.user_id = $SESSION['user_id'];");
            $stmt->bindParam(':user_id', $user_id);
                                    
            $stmt->execute();
            $stmtFetchAll = $stmt->fetch(PDO:: FETCH_ASSOC);
            return $stmtFetchAll
        }

        public function selectUsers($game_id){
            $stmt = $this->conn->prepare("SELECT user.username
                                        FROM games
                                        INNER JOIN user_games ON user.id = user_games.user_id
                                        WHERE user_games.game_id = $SESSION['game_id'];");
            $stmt->bindparam(':game_id', $game_id);

            $stmt->execute();
            $stmtFetchAll = $stmt->fetch(PDO:: FETCH_ASSOC);
            return $stmtFetchAll
        }
    }

?>