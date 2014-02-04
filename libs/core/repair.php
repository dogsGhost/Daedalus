<?php

class Repair {

	public static function rebuildTables() {
		global $con;
		//Drop all tables
		$tables = ['sessions'];
		foreach($tables as $table) {
			$con->query("DROP TABLE `$table`");
		}
		//Sessions Table
		$con->query("CREATE TABLE `sessions` (
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