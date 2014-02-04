<?php

class Controller {

	protected $_model = null;
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $_validation = [];

	public function __construct($uri) {
		//Resolve and autoload model
		if (class_exists($uri['model'])) {
			$this->_model = new $uri['model']();
		}
		//Resolve controller and action
		$this->_controller = $uri['controller'];
		$this->_action = (method_exists($this, $uri['action'])) ? $uri['action'] : "index";
		//Build template
		$this->_template = new Template($this->_controller, $this->_action);
		//Auto-authenticate if required
		if (method_exists($this, "auth")) {
			$this->auth();
		}
		//Set default title
		global $config;
		$this->_template->set("page", $this->_controller);
		$this->_template->set("title", ucwords($this->_controller)." | $config[app_name]");
	}

	public function index() {
	}

	public function __destruct() {
		$this->_template->render();
	}


}