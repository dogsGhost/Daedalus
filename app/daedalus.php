<?php

class Daedalus {

	public static $config;
	public static $session;
	private static $_controller;

	public static function fly() {
		self::$config = include('config/config.php');
		self::$session = Session::getInstance();
		self::hook();
	}

	private static function hook() {
		$uri = self::getURI((!empty($_GET['url'])) ? $_GET['url'] : "Home");
		//Resolve controller
		$controller = self::resolveController($uri['controller']);
		$controller = new $controller(self::$_controller, $uri['action'], $uri['model']);
		//Resolve and hook into action
		$action = self::resolveAction($controller, $uri['action']);
		$controller->$action();
	}

	private static function getURI($url) {
		$components = explode("/", $url);
		$uri['controller'] = (!empty($components) && $components[0]!=='') ? ucwords($components[0]) : "Home";
		$uri['model'] = rtrim($uri['controller'], 's')."Model";
		array_shift($components);
		$uri['action'] = (!empty($components)) ? $components[0] : "index";
		return $uri;
	}

	private static function resolveController($controller) {
		self::$_controller = (class_exists($controller."Controller")) ? $controller : "Error";
		return self::$_controller."Controller";
	}

	private static function resolveAction($controller, $action) {
		return (is_callable($controller, $action)) ? $action : "index";
	}

}