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
		//Resolve controller and action
		self::$controller = $uri['controller'];
		$controller = self::$controller."Controller";
		Daedalus::$action = "index";
		if (class_exists($controller)) {
			Daedalus::$action = method_exists($controller, $uri['action']) ? $uri['action'] : Daedalus::$action;
			$controller = new $controller($uri['model']);
		} else {
			$controller = new ErrorController();
		}
		$action = Daedalus::$action;
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