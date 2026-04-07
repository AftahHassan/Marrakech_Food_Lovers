<?php
require_once __DIR__ . '/../models/Database.php';

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    //les getters
    public function getId(){
        return $this -> id;
    }

    public function getUsername(){
        return $this -> username;
    }

    public function getEmail(){
        return $this -> email;
    }

    public function getRole(){
        return $this -> role;
    }

    
}







?>