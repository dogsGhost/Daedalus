<?php

class Controller {

	protected $_controller;
	protected $_action;
	protected $_model;
	protected $_template;

	public function __construct($controller, $action, $model = null) {
		$this->_controller = $controller;
		//Resolve action and view
		$this->_action = (is_callable($this, $action)) ? $action : "index";
		$this->_view = $this->_controller."/$this->_action";
		//Resolve and autoload model
		if (class_exists($model)) {
			$this->_model = new $model();
		}
		$this->_template = new Template($this->_controller, $this->_action);
	}

	public function index() {}

	public function __destruct() {
		$this->_template->render();
	}

}