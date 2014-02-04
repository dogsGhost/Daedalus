<?php

class Model extends MySQLConnection {

	public $attributes = [];

	public function __construct() {
		$this->connect();
	}

	public function set($attribute, $val) {
		$this->attributes[$attribute] = $val;
	}

	public function get($attribute) {
		return (isset($this->attributes[$attribute])) ? $this->attributes[$attribute] : null;
	}
	
}