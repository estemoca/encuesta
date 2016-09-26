<?php

/**
 * @author karla
 */
class UsersTable {
    
    protected static $_instance = null;

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }
    
    public function getByEmail($userEmail)
    {
        $dbCon = Initializer::getInstance()->getDb();
        $st = $dbCon->prepare("SELECT * FROM users WHERE email=?");
        $st->execute(array($userEmail));
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        if (count($rows)) {
            $user = new User($rows);
        }
        return $user;
    }
    public function getById($userId)
    {
        $dbCon = Initializer::getInstance()->getDb();
        $st = $dbCon->prepare("SELECT * FROM users WHERE id=?");
        $st->execute(array($userId));
        $row = $st->fetch(PDO::FETCH_ASSOC);
        if (count($row)) {
            $user = new User($row);
        }
        return $user;
    }
    public function create($user){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("INSERT INTO users (email, fullname, nickname, password) VALUES (?,?,?,?)");
        return $stmt->execute(array($user->getEmail(), $user->getFullname(), $user->getNickname(), $user->getPassword()));
    }
    public function update ($user){
        $db = Initializer::getInstance()->getDb();
        $stmt = $db->prepare("UPDATE users SET email=?, fullname=?, nickname=?, state=? WHERE id=?");
        return $stmt->execute(array($user->getEmail(), $user->getFullname(), $user->getNickname(), $user->getState(), $user->getId()));        
    }
    public function getUsersLogged(){
        $Action = new Action();
        $userLogged = $Action->getAuth();
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM users WHERE state=1 and id !=?");
        $stmt->execute(array($userLogged->getId()));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $resp[] = new User($row);
        }
        return $resp;
    }
    
    public function getAll(){
        $Action = new Action();
        $userLogged = $Action->getAuth();
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM users WHERE id !=? order by state desc");
        $stmt->execute(array($userLogged->getId()));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $resp[] = new User($row);
        }
        return $resp;
    }
}
