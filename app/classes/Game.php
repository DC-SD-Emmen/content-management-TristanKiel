<?php

    class Game {
        private $id;
        private $game_id;
        private $title;
        private $genre;
        private $platform;
        private $release_year;
        private $rating;
        private $image;

        public function __construct($id, $game_id, $title, $genre, $platform, $release_year, $rating, $image) {
            $this->id = $id;
            $this->game_id = $game_id;
            $this->title = $title;
            $this->genre = $genre;
            $this->platform = $platform;
            $this->release_year = $release_year;
            $this->rating = $rating;
            $this->image = $image;
        }

        // setter en getter methoden

        public function setId($id) {
            $this->id = $id;
        }

        public function setGameId($game_id) {
            $this->game_id = $game_id;
        }

        public function getGameId() {
            return $this->game_id;
        }

        public function getId() {
            return $this->id;
        }
        
        public function setTitle($title) {
            $this->title = $title;
        }

        public function getTitle() {
            return $this->$title;
        }

        public function setGenre($genre) {
            $this->genre = $genre;
        }

        public function getGenre() {
            return $this->$genre;
        }

        public function setPlatform ($platform){
            $this->platform = $platform;
        }

        public function getPlatform () {
            return $this->platform;
        }

        public function setRelease_year ($release_year) {
            $this->release_year = $release_year;
        }

        public function getRelease_year () {
            return $this->release_year;
        }

        public function setRating ($rating) {
            $this->rating = $rating;
        }

        public function getRating () {
            return $this->rating;
        }
        public function setImage ($image) {
            $this->image = $image;
        }
        public function getImage () {
            return $this->image;
        }




    }

?>