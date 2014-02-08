<?php

class Template {

	private $template = "main";
	private $vars = [
		"view" => "index",
		"title" => "Daedalus MVC Framework"
	];

	public function __construct($controller, $action) {
		$this->set("view", strtolower("$controller/$action"));
		$this->set("page", strtolower($controller));
	}

	public function set($name, $val) {
		$this->vars[$name] = $val;
	}

	public function setView($view) {
		$this->view = $view;
	}

	public function setTemplate($template) {
		$this->template = file_exists(TEMPLATES_DIR."/$template.php") ? $template : $this->template;
	}

	public function render() {
		extract($this->vars);
		include TEMPLATES_DIR."/$this->template.php";
	}

}