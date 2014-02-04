<?php

class Template {

	private $controller; 
	private $dir;
	private $view;
	private $template = "main";
	private $vars = [
		"title" => "default template title",
		"validation" => []
	];

	public function __construct($controller, $action) {
		$this->controller = strtolower($controller);
		$this->view = strtolower($action);
		$this->vars['active'] = $controller;
		global $paths;
		$this->dir = $paths['templates'];
	}

	public function set($name, $val) {
		$this->vars[$name] = $val;
	}

	public function setView($view) {
		$this->view = $view;
	}

	public function setTemplate($template) {
		$this->template = (file_exists($this->dir."/$template.php")) ? $template : $this->template;
	}

	public function render() {
		global $paths;
		extract($this->vars);
		include "$this->dir/$this->template.php";
	}

}