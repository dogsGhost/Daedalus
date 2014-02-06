<?php

/***** < CONFIGURATION > *****/
//Environment
$config['environment'] = "local";
$config['mode'] = "development"; //development || production
$config['base_dir'] = "daedalus"; //null if root

/***** < DATABASE CONFIGURATION > *****/
switch ($config['environment']) {
	case 'local':
		$config['db']['host'] = "127.0.0.1";
		$config['db']['name'] = "robinson";
		$config['db']['user'] = "root";
		$config['db']['pass'] = "";
	break;
	case 'server':
		//$config['db']['host'] = null;
		//$config['db']['name'] = null;
		//$config['db']['user'] = null;
		//$config['db']['pass'] = null;
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
$config['session']['db_sync'] = 60 * 1; //1 minute || false to turn off sync

/***** < CORE SYSTEM PATHS > *****/
$root = $_SERVER["DOCUMENT_ROOT"];
$root .= ($config['base_dir'] !== null) ? "/".$config["base_dir"] : ''; 
define('ROOT_DIR', $root);
define('APP_DIR', ROOT_DIR."/app");
define('LIBS_DIR', ROOT_DIR."/libs");
define('TEMP_DIR', ROOT_DIR."/temp");
define('PUBLIC_DIR', ROOT_DIR."/public");
define('VIEWS_DIR', APP_DIR."/views");
define('TEMPLATES_DIR', VIEWS_DIR."/templates");

/***** < PUBLIC URL CONSTANTS > *****/
$root = $config["protocol"].$config["host"];
$root .= ($config['base_dir'] !== null) ? "/".$config["base_dir"] : '';
define("URL_HOME", $root);
define("URL_PUBLIC", URL_HOME."/public");
define("URL_STYLES", URL_PUBLIC."/styles");
define("URL_SCRIPTS", URL_PUBLIC."/scripts");

/***** < ERROR REPORTING > *****/
error_reporting(E_ALL);
ini_set('error_log', TEMP_DIR.'/log.log');

if ($config['debug']) {
	ini_set('display_errors', '1');
} else {
    ini_set('display_errors','Off');
    ini_set('log_errors', 'On');
}

/***** < LOAD REQUIRED FILES > *****/
require LIBS_DIR.'/loader.php';
//Libraries
Auto_Loader::load([
	LIBS_DIR => [
		'database',
		'core',
		'mvc',
		'helpers'
	],
	APP_DIR => [
		'models',
		'controllers'
	]
]);

//DB DEBUGGING TOOL
if (isset($_GET['rebuild'])) {
	$repair = new Repair();
	$repair->rebuildTables();
}