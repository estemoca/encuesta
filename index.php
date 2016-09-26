<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
require_once 'includes.php';
session_start();
$c = new Controller();
echo $c->init();