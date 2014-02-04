<?php

class Auto_Loader {

	private static $path;

	public static function setPath($path) {
		self::$path = $path;
	}

	//Loads a library from either directory name or array of directories
	public static function load($directories) {
		foreach($directories as $dir) {
			self::includeFiles($dir);
		}
	}

	private static function includeFiles($dir) {
		$dir = self::$path."/$dir/";
		if (is_dir($dir)) {
			foreach(glob($dir."/*.php") as $file) {
				require($file);
			}
		} else {
			die("Failed to autoload directory: $dir");
		} 
	}

}