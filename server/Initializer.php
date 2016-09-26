<?php

/**
 * Inicialize db
 *
 * @author karla
 */
class Initializer {
  private $_config;
  private $_db;
  protected static $_instance = null;
  
  public function __construct ()
  {
    $config = parse_ini_file(dirname(__FILE__) . "/../config/environment.ini", true);
    $this->_config = $config;
    $this->initDb();
  }
  public function initDb(){
    $dbPassword = isset($this->_config['database']['pass']) ? $this->_config['database']['pass'] : null;
    $dsn = 'mysql:host=' . $this->_config['database']['host'] . ';dbname=' . $this->_config['database']['name'] . ';charset=utf8';
    $this->_db = new PDO($dsn, $this->_config['database']['owner'],$dbPassword);
      
  }
  public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }

    public function getDb() {
        return $this->_db;
    }
    
    
}
