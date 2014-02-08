<?php

class Session {

	use MySQLConnection;
	private $config;
	private static $instance;

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new Session();	
		}
		return self::$instance;
	}

	private function __construct() {
		$this->connect();
		foreach(Daedalus::$config['session'] as $var => $val) {
			$this->config[$var] = $val;
		}
		$this->start();
	}

	/**************** < PUBLIC METHODS > *******************/

	public function authenticate() {
		$errors = [];
		/***** < Logged in users > *****/
		if ($this->get("logged_in") === true) {
			//Session expiration
			if ((time() - $this->get('last_active')) > $this->config['expiration']) {
				$errors[] = "Session has expired. User has been logged out.";
			}
		}
		return (empty($errors)) ? true : false;
	}

	public function destroy() {
		session_unset();
		session_destroy();
		$this->start();
	}
	
	/**************** < PRIVATE METHODS > *******************/

	private function start() {
		session_start();
		if (empty($_SESSION)) {
			$this->init();
		}
		$this->update();
	}

	//Initializes properties in a new session
	private function init() {
		session_regenerate_id(true);
		$this->set('IP', $_SERVER['REMOTE_ADDR']);
		$this->set('user', null);
	}

	//Updates session variables
	private function update() {
		$this->set('views', ($this->get('views')===null) ? 1 : $this->get('views') + 1);
		$this->set('last_active', time());
		if (time() - $this->get("last_sync") > $this->config['db_sync']) {
			$this->sync();
		}
	}

	//Push session data to database
	private function sync() {
		//Return if session syncing is disabled
		if ($this->config['db_sync'] === false) {
			return;
		}
		$session_id = session_id();
		$views = $this->get("views");
		$IP = $this->get("IP");
		//Determine whether or not this session exists in the database
		$result = $this->query("SELECT COUNT(*) FROM `sessions` WHERE `session_id` = '$session_id'");
		$result = intval($result->fetch_row()[0]);
		//Session doesn't exist within the database
		if ($result===0 || $result===null) {
			$stmt = $this->prepare("INSERT INTO `sessions` 
				(session_id, ip) 
				VALUES (?,?)
			");
			$stmt->bind_param('ss', $session_id, $IP);
		}
		//Session exists, update fields
		else {
			$stmt = $this->prepare("UPDATE `sessions` SET 
				`last_active`=now(), 
				views = ? 
				WHERE `session_id`=?"
			);
			$stmt->bind_param('is',$views,$session_id);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		$this->set('last_sync', time());
	}

	/**************** < PUBLIC GET/SET METHODS > *******************/

	public function set($property, $value) {
		$_SESSION[$property] = $value;
	}

	public function get($property) {
		return (!empty($_SESSION) && isset($_SESSION[$property])) ? $_SESSION[$property] : null;
	}

}