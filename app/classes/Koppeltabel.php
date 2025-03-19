<?php
    // zorgt voor koppeling tussen gebruikers en games
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
            $stmt = $this->conn->prepare("SELECT *
                                        FROM games
                                        INNER JOIN user_games ON games.id = user_games.game_id
                                        WHERE user_games.user_id = :user_id;");
            $stmt->bindParam(':user_id', $user_id);
                                    
            $stmt->execute();
            $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultaten = $stmt->fetchALl();

            $games = [];
            foreach($resultaten as $resultaat) {
                $game = new Game($resultaat['id'], $resultaat['game_id'], $resultaat['title'], $resultaat['genre'], $resultaat['platform'], $resultaat['release_year'], $resultaat['rating'], $resultaat['image']);
                array_push($games, $game);
            }
            return $games;
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