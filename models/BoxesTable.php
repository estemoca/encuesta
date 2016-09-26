<?php

/**
 * @author karla
 */
class BoxesTable {
    
    protected static $_instance = null;

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }
    
    public function create($box){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("INSERT INTO boxes (xpos, ypos, color,creator_id,game_id) VALUES (?,?,?,?,?)");
        return $stmt->execute(array($box->getXPos(),$box->getYPos(), $box->getColor(), $box->getCreatorId(),$box->getGameId()));
    }
    public function update($box){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("UPDATE boxes set xpos=?, ypos=?, color=?,creator_id=?,game_id=? WHERE id=?");
        return $stmt->execute(array($box->getXPos(),$box->getYPos(), $box->getColor(), $box->getCreatorId(),$box->getGameId(),$box->getId()));
    }
    public function getLastBox($loggedId,$gameId){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("SELECT * FROM boxes WHERE id = (SELECT MAX(id) FROM boxes WHERE creator_id=? AND game_id=?)");
        $stmt->execute(array($loggedId,$gameId));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row)) {
            $box = new Box($row);
        }
        return $box;
    }
    
    public function delete($box){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("DELETE FROM boxes WHERE id = ?");
        return  $stmt->execute(array($box->getId()));
    }

    public function getBoxesByGame($gameId){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("SELECT * FROM boxes WHERE game_id=?");
        $stmt->execute(array($gameId));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $boxes[] = new Box($row);
        }
        return $boxes;
    }
   
    public function getById($boxId)
    {
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("SELECT * FROM boxes WHERE id=?");
        $stmt->execute(array($boxId));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row)) {
            $box = new Box($row);
        }
        return $box;
    }
}
