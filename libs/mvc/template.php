<?php

class Template {

	private $_template = "main";
	private $_vars = [
		"view" => "index",
		"title" => "Daedalus MVC Framework"
	];

	public function __construct($controller, $action) {
		$this->setView("$controller/$action");
		$this->set("page", strtolower($controller));
	}

	public function set($name, $val) {
		$this->_vars[$name] = $val;
	}

	public function setView($view) {
		$this->set("view", strtolower($view));
	}

	public function setTemplate($template) {
		$this->_template = file_exists(TEMPLATES_DIR."/$template.php") ? $template : $this->_template;
	}

	public function render() {
		extract($this->_vars);
		include TEMPLATES_DIR."/$this->_template.php";
	}

}