<?php

class Action {
    
    public $params = array();
    public $view = array();
    public $viewvars = array();
    
    function init(){
        $prettyParams = $this->getPrettyParams();
        $this->view = (isset($prettyParams[0]) && $prettyParams[0]!='') ? $prettyParams[0] : "index";
        if(count($prettyParams) > 1){
            array_shift($prettyParams);
            $this->params = $prettyParams;
        }
        $this->viewvars["loggedname"] = "";
        $user = $this->getAuth();
        if($user){
            $this->viewvars["loggedname"] = $user->getNickname();
        } elseif(!($this->view == "index" || $this->view == "loadepsXHR" || $this->view == "loaddepartamentosXHR"  || $this->view == "createpacienteXHR" || $this->view == "getmunicipioXHR"
                   || $this->view == "deletepacienteXHR" || $this->view == "updatepacienteXHR" || $this->view == "getpacienteXHR" || $this->view == "getmunicipiosbydepartamentoXHR")) {
            header("Location: " . BASE_URL . "index");
        }
        
        
        $this->{$this->view}();
        include (ROOT . "/views/" . $this->view . ".php");
    }
    
    function getPrettyParams(){
        $url = $this->curPageURL();
        $url = "/" . str_replace(BASE_URL, "", $url);
//        var_dump($url);
        $params = explode("/", $url);
        array_shift($params);
        return $params;
    }
    
    //To get the current user
    function getAuth(){
        $user = null;
        if(isset($_SESSION['loggeduser']) && $_SESSION['loggeduser']){
            $user = UsersTable::getInstance()->getById($_SESSION['loggeduser']);
        }
        return $user;
    }
    //setting current session user id
    function setAuth($user){
        $_SESSION['loggeduser'] = $user->getId();
        $user->setState(true);
        UsersTable::getInstance()->update($user);
        return true;
    }
    function deleteAuth(){
        session_destroy();
        $user = $this->getAuth();
        $user->setState(false);
        UsersTable::getInstance()->update($user);
        return true;
    }
    
    function curPageURL() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

}