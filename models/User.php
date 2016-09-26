<?php

/**
 * @author karla
 */
class User {
    //properties
     private $_id;
     private $_fullname;
     private $_nickname;
     private $_email;
     private $_password;
     private $_state;
     
    public function __construct($params) {
        $this->populate($params);
    }
    
    
    public function populate($params){
        $this->setId($params['id']);
        $this->setFullname($params['fullname']);
        $this->setNickname($params['nickname']);
        $this->setEmail($params['email']);
        $this->setPassword($params['password']);
        $this->setState($params['state']);
    }
    //setters
    public function setId($id){
        $this->_id = $id;
    }
    public function setFullname($fullname){
        $this->_fullname = $fullname;
    }
    public function setNickname($nickname){
        $this->_nickname = $nickname;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setPassword($password){
        $this->_password = $password;
    }
    public function setState($state){
        $this->_state = $state;
    }
    //getters
    public function getId(){
        return $this->_id;
    }
    public function getFullname(){
        return $this->_fullname;
    }
    public function getNickname(){
        return $this->_nickname;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getPassword(){
        return $this->_password;
    }
    public function getState(){
        return $this->_state;
    }
    
     
}
