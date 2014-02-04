<?php

class Hook {

	public static function build($url) {
		$uri = self::getURI($url);
		//Resolve controller
		$controller = $uri['controller']."Controller";
		if (class_exists($controller)) {
			$controller = new $controller($uri);
		} else {
			Log::write("Failed to include controller: ".$uri['controller']);
			$uri['controller'] = "Error";
			$controller = new ErrorController($uri);
		}
		//Call requested action, or index if it doesn't exist
		$action = method_exists($controller, $uri['action']) ? $uri['action'] : "index";
		$controller->$action();
	}

	private static function getURI($url) {
		$uri = [];
		$components = explode("/", $url);
		$uri['controller'] = (!empty($components) && $components[0]!=='') ? ucwords($components[0]) : "Home";
		$uri['model'] = rtrim($uri['controller'], 's');
		array_shift($components);
		$uri['action'] = (!empty($components)) ? $components[0] : null;
		return $uri;
	}

}