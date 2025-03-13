<?php

    class Game {
        private $title;
        private $genre;
        private $platform;
        private $release_year;
        private $rating;


        // setter en getter methoden
        
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




    }

?>