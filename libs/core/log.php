<?php

class Log {

	private static $messages = [];

	public static function write($message, $die = false) {
		self::$messages[] = $message;
		if ($die === true) {
			$this->dump();
			die("Terminating application.");
		}
	}

	public static function dump() {
		echo "Dumping log...<br/><ul>";
		foreach (self::$messages as $message) {
			echo "<li>$message</li>";
		}
		echo "</ul>";
	}
}