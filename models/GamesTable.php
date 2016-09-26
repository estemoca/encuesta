<?php

/**
 * @author karla
 */
class GamesTable {
    
    protected static $_instance = null;

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }
    
    public function getGames($userId){
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM games "
                . " JOIN users AS col ON col.id = collab_id AND col.state =1"
                . " JOIN users AS cre ON cre.id = user_id AND cre.state =1"
                . " WHERE games.user_id =? OR games.collab_id =?");
        $stmt->execute(array($userId,$userId));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $resp[] = new Game($row);
        }
        return $resp;
    }
    
    public function create($game){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("INSERT INTO games (user_id, collab_id) VALUES (?,?)");
        return $stmt->execute(array($game->getUserId(),$game->getCollabId()));
    }
    
    public function getGameStarted($userId,$collabId){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("SELECT * FROM games WHERE user_id=? and collab_id=? or user_id=? and collab_id=?");
        $stmt->execute(array($userId,$collabId,$collabId,$userId));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row)) {
            $game = new Game($row);
        }
        return $game;
    }
    
    public function getById($gameId)
    {
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("SELECT * FROM games WHERE id=?");
        $stmt->execute(array($gameId));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row)) {
            $game = new Game($row);
        }
        return $game;
    }
}
