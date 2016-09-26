<?php

/**
 * @author karla
 */
class Box {
    //properties
     private $_id;
     private $_creator_id;
     private $_xpos;
     private $_ypos;
     private $_color;
     private $_game_id;
     
    public function __construct($params=null) {
        if($params != null) {
            $this->populate($params);
        }
    }
    
    public function populate($params){
        $this->setId($params['id']);
        $this->setXPos($params['xpos']);
        $this->setYPos($params['ypos']);
        $this->setColor($params['color']);
        $this->setCreatorId($params['creator_id']);
        $this->setGameId($params['game_id']);
    }
    //setters
    public function setId($id){
        $this->_id = $id;
    }
    public function setCreatorId($creatorId){
        $this->_creator_id = $creatorId;
    }
    public function setXPos($xpos){
        $this->_xpos= $xpos;
    }
    public function setYPos($ypos){
        $this->_ypos = $ypos;
    }
    public function setColor($color){
        $this->_color = $color;
    }
    public function setGameId($gameId){
        $this->_game_id = $gameId;
    }
    //getters
    public function getId(){
        return $this->_id;
    }
    public function getCreatorId(){
        return $this->_creator_id;
    }
    public function getXPos(){
        return $this->_xpos;
    }
    public function getYPos(){
        return $this->_ypos;
    }
    public function getColor(){
        return $this->_color;
    }
    public function getGameId(){
        return $this->_game_id;
    }
     
}
