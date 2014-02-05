<?php

class Repair extends MySQLConnection {

	public function __construct() {
	}

	public function rebuildTables() {
		//Drop all tables
		$tables = ['sessions'];
		foreach($tables as $table) {
			$this->query("DROP TABLE `$table`");
		}
		//Sessions Table
		$this->query("CREATE TABLE `sessions` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`session_id` VARCHAR(32) NOT NULL,
			`last_active` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`IP` VARCHAR(18) NOT NULL,
			`user` LONGTEXT NULL DEFAULT NULL,
			`views` INT NOT NULL DEFAULT 1,
			PRIMARY KEY (`id`)
		)");
	}
}