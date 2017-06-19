<?php

/**
 * Torn on display errors in localhost
 */
if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1'])) {
//    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
}

/**
 * Prepare environment of application
 */
require_once 'src/start.php';
use Bundles\Components\Router;

define('ROOT', dirname(__FILE__)); //Global variable for file routing

/**
 * Start application
 */
$router = new Router();
$router->run();