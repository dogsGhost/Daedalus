<?php

class Controller {

	protected $_model = null;

	public function __construct($model = null) {
		//Resolve and autoload model
		if ($model !== null && class_exists($model)) {
			$this->_model = new $model();
		}
		$this->_template = new Template(Daedalus::$controller, Daedalus::$action);
		//Auto-authenticate if required
		if (is_callable($this, "auth")) {
			$this->auth();
		}
	}

	public function index() {
	}

	public function __destruct() {
		$this->_template->render();
	}

}