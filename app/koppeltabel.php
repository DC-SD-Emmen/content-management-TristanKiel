<?php

    class koppeltabel{

        public function insert(){
            $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id) VALUES (20, 27)");
            $stmt->execute();
        }

        public function selectGames(){
            $stmt = $this->conn->prepare("SELECT games.title FROM games");
            $stmt = $this->conn->prepare("INNER JOIN user_games ON games.id = user_games.game_id");
            $stmt = $this->conn->prepare("WHERE user_games.game_id = 20");
            $stmt->execute();
        }

        public function selectUsers(){
            $stmt = $this->conn->prepare("SELECT user.username FROM games");
            $stmt = $this->conn->prepare("INNER JOIN user_games ON user.id = user_games.user_id");
            $stmt = $this->conn->prepare("WHERE user_games.game_id = 27");
            $stmt->execute();
        }
    }

?> 