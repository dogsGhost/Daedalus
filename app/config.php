<?php

/***** < CONFIGURATION > *****/
$config = [];

//Environment
$config['environment'] = "local";
$config['mode'] = "development";

/***** < DATABASE CONFIGURATION > *****/
$db_config = [];

if ($config['environment']=="local") {
	$db_config['host'] = "127.0.0.1";
	$db_config['name'] = "robinson";
	$db_config['user'] = "root";
	$db_config['pass'] = "";
} elseif ($config['environment']=="server") {
	/***************************
	$db_config['host'] = null;
	$db_config['name'] = null;
	$db_config['user'] = null;
	$db_config['pass'] = null;
	****************************/
} else {
	$db_config = null;
}

/***** < APPLICATION CONFIGURATION > *****/
$config['app_name'] = "daedalus";
$config['protocol'] = "http://";
$config['host'] = ($config["environment"]=="local") ? "localhost:8080" : "yourdomain.com";
$config['debug'] = ($config['mode']=="development") ? true : false;

/***** < SESSION CONFIGURATION > *****/
$session_config['allow_proxy'] = false;
$session_config['expiration'] = 60 * 10; //10 minutes
$session_config['db_sync'] = 60 * 1; //1 minute

/***** < CORE SYSTEM PATHS > *****/
$paths = [];
$paths['root'] = $_SERVER["DOCUMENT_ROOT"];
$paths['root'] .= ($config['app_name'] !== null) ? "/".$config["app_name"] : '';
$paths['app'] = $paths['root']."/app";
$paths['libs'] = $paths['root']."/libs";
$paths['public'] = $paths['root']."/public";
$paths['views'] = $paths['app']."/views";
$paths['templates'] = $paths['views']."/templates";

//Public URL Constants
$root = $config["protocol"].$config["host"];
$root .= ($config['app_name'] !== null) ? "/".$config["app_name"] : '';
define("URL_HOME", $root);
define("URL_PUBLIC", URL_HOME."/public");
define("URL_STYLES", URL_PUBLIC."/styles");
define("URL_SCRIPTS", URL_PUBLIC."/scripts");

/***** < ERROR REPORTING > *****/
if ($config['debug']) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors','Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', 'log.log');
}

/***** < LOAD REQUIRED FILES > *****/
require $paths['libs'].'/loader.php';
//Load Libraries
Auto_Loader::setPath($paths['libs']);
Auto_Loader::load([
	'database',
	'core',
	'mvc',
	'helpers'
]);
//Load Model and Controller Files
Auto_Loader::setPath($paths['app']);
Auto_Loader::load([
	'models',
	'controllers'
]);

//DB DEBUGGING TOOL
if (isset($_GET['rebuild'])) {
	Repair::rebuildTables();
}

/***** < OK! START SESSION > *****/
$session = new Session();
$session->start();

if (isset($_GET['destroy'])) {
	$session->destroy();
}