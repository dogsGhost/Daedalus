<?php

class MySQLConnection {

	private $con = null;

	/************* < PUBLIC METHODS > ***************/

	public function garbageCollect() {
		//Remove expired sessions
		$this->con->query("DELETE FROM `sessions` WHERE NOW() - INTERVAL 3600 SECOND > last_active");
	}

	public function __destruct() {
		$this->close();
	}

	/************* < EXTENDED SQL FUNCTIONS > ***************/
	
	public function fetchCount($stmt) {
		$result = $stmt->get_result();
		$result = intval($result->fetch_row()[0]);
		return $result;
	}

	/************* < BASE SQL FUNCTIONS > ***************/

	public function query($query) {
		return $this->con->query($query);
	}

	public function prepare($query) {
		return $this->con->prepare($query);
	}

	public function connect() {
		global $db_config;
		if ($this->con === null && $db_config !== null) {
			$this->con = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
		}
	}

	private function close() {
		$this->con->close();
	}

}