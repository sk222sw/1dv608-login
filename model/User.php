<?php

class User {
    
    private $userName;
    private $password;
    
    public function __construct($userName, $password) {
        
        
        
        $this->userName = $userName;
        $this->password = $password;
    }
    
    public function getUserName() {
        
    }
    
}