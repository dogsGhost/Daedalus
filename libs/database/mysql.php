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
		global $config;
		if ($this->con === null && !empty($config['db'])) {
			$this->con = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
		}
	}

	private function close() {
		$this->con->close();
	}

}