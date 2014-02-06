<?php

class Controller {

	protected $_model;
	protected $_validation = [];

	public function __construct($uri) {
		//Resolve and autoload model
		if (class_exists($uri['model'])) {
			$this->_model = new $uri['model']();
		}
		$this->_template = new Template(Daedalus::$controller, Daedalus::$action);
		//Auto-authenticate if required
		if (method_exists($this, "auth")) {
			$this->auth();
		}
	}

	public function index() {
	}

	public function __destruct() {
		$this->_template->render();
	}


}