<?php

class Auto_Loader {

	//Loads a library from either directory name or array of directories
	public static function load($directories) {
		foreach($directories as $path => $val) {
			foreach($val as $dir) {
				self::includeFiles("$path/$dir");
			}
		}
	}

	private static function includeFiles($dir) {
		if (is_dir($dir)) {
			foreach(glob($dir."/*.php") as $file) {
				require($file);
			}
		} else {
			die("Failed to autoload directory: $dir");
		} 
	}

}