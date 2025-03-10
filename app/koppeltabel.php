<?php

    public function insert(){
        $stmt = $this->conn->prepare("INSERT INTO user_games");
        $stmt->execute();
    }

    public function select(){
        $stmt = $this->->prepare("SELECT games.title FROM games");
        $stmt->execute();
    }

?> 