<?php

/**
 * @author karla
 */
class Game {
    //properties
     private $_id;
     private $_user_id;
     private $_collab_id;
     private $_date;
     
    public function __construct($params=null) {
        if($params != null) {
            $this->populate($params);
        }
    }
    
    
    public function populate($params){
        $this->setId($params['id']);
        $this->setUserId($params['user_id']);
        $this->setCollabId($params['collab_id']);
        $this->setDate($params['date']);
    }
    //setters
    public function setId($id){
        $this->_id = $id;
    }
    public function setUserId($userId){
        $this->_user_id = $userId;
    }
    public function setCollabId($collabId){
        $this->_collab_id = $collabId;
    }
    public function setDate($date){
        $this->_date = $date;
    }
    //getters
    public function getId(){
        return $this->_id;
    }
    public function getUserId(){
        return $this->_user_id;
    }
    public function getCollabId(){
        return $this->_collab_id;
    }
    public function getDate(){
        return $this->_date;
    }
     
}
