<?php

class Model {

	use MySQLConnection;
	public $properties = [];

	public function __construct() {
		$this->connect();
	}

	public function set($key, $val) {
		$this->properties[$key] = $val;
	}

	public function get($key) {
		return (isset($this->properties[$key])) ? $this->properties[$key] : null;
	}
	
}