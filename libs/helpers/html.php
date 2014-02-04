<?php

class HTML_Helper {

	public static function linkTag($file) {
		echo '<link rel="stylesheet" type="text/css" href="'.URL_STYLES."/$file\">\n";
	}

	public static function scriptTag($file) {
		echo '<script type="text/javascript" src="'.URL_SCRIPTS."/$file\"></script>\n";
	}

}