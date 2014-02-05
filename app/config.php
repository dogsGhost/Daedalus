<?php

/***** < CONFIGURATION > *****/
//Environment
$config['environment'] = "local";
$config['mode'] = "development";
$config['base_dir'] = "daedalus";

/***** < DATABASE CONFIGURATION > *****/
switch ($config['environment']) {
	case 'local':
		$config['db']['host'] = "127.0.0.1";
		$config['db']['name'] = "robinson";
		$config['db']['user'] = "root";
		$config['db']['pass'] = "";
		break;
	case 'server':
		/*$config['db']['host'] = "127.0.0.1";
		$config['db']['name'] = "robinson";
		$config['db']['user'] = "root";
		$config['db']['pass'] = "password";*/
		break;
}

/***** < APPLICATION CONFIGURATION > *****/
$config['title'] = "Daedalus MVC";
$config['protocol'] = "http://";
$config['host'] = ($config["environment"]=="local") ? "localhost:8080" : "yourdomain.com";
$config['debug'] = ($config['mode']=="development") ? true : false;

/***** < SESSION CONFIGURATION > *****/
$config['session']['allow_proxy'] = false;
$config['session']['expiration'] = 60 * 10; //10 minutes
$config['session']['db_sync'] = 60 * 1; //1 minute

/***** < CORE SYSTEM PATHS > *****/
$paths['root'] = $_SERVER["DOCUMENT_ROOT"];
$paths['root'] .= ($config['base_dir'] !== null && $config['base_dir'] !== "") ? "/".$config["base_dir"] : '';
$paths['app'] = $paths['root']."/app";
$paths['libs'] = $paths['root']."/libs";
$paths['public'] = $paths['root']."/public";
$paths['views'] = $paths['app']."/views";
$paths['templates'] = $paths['views']."/templates";

/***** < PUBLIC URL CONSTANTS > *****/
$root = $config["protocol"].$config["host"];
$root .= ($config['base_dir'] !== null) ? "/".$config["base_dir"] : '';
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
	$repair = new Repair();
	$repair->rebuildTables();
}

/***** < OK! START SESSION > *****/
$session = new Session($config['session']);
$session->start();

if (isset($_GET['destroy'])) {
	$session->destroy();
}