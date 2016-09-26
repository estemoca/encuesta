<?php

set_include_path(get_include_path() 
        . PATH_SEPARATOR . dirname(__FILE__) . '/models/' 
        . PATH_SEPARATOR . dirname(__FILE__) . '/server/');
$config = parse_ini_file(dirname(__FILE__) . "/config/environment.ini", true);

function __autoload($className) {
    include $className . '.php';
}
define('ROOT',dirname(__FILE__));
define("BASE_URL", $config['base_url']);

?>
