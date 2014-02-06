<?php

class Daedalus {

	public static $config;
	public static $session;
	public static $controller;
	public static $action;

	public static function fly() {
		self::$config = include('config/config.php');
		self::$session = Session::getInstance();
		self::hook();
	}

	private static function hook() {
		$uri = self::getURI((!empty($_GET['url'])) ? $_GET['url'] : "Home");
		self::$controller = $uri['controller'];
		$controller = self::$controller."Controller";
		//Resolve controller and action
		$action = "index";
		if (class_exists($controller)) {
			$action = method_exists($controller, $uri['action']) ? $uri['action'] : $action;
			Daedalus::$action = $action;
			$controller = new $controller($uri);
		} else {
			$controller = new ErrorController();
		}
		$controller->$action();
	}

	private static function getURI($url) {
		$components = explode("/", $url);
		$uri['controller'] = (!empty($components) && $components[0]!=='') ? ucwords($components[0]) : "Home";
		$uri['model'] = rtrim($uri['controller'], 's')."Model";
		array_shift($components);
		$uri['action'] = (!empty($components)) ? $components[0] : null;
		return $uri;
	}

}