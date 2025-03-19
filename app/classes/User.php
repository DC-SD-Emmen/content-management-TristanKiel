<?php

class User {

    private $userid;
    private $username;
    private $useremail;

    public function __construct($id, $username) {
        $this->userid = $id;
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getUserID() {
        return $this->userid;
    }

}


?>