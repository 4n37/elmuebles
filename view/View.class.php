<?php

class View {

	private $controller;

	public function __construct(Controller $controller) {
		$this->controller = $controller;
	}

	public function render($tpl) {
		$innerTpl = __DIR__ ."/templates/$tpl.php";
		if(!file_exists($innerTpl)) {
			throw new Exception("The template '$tpl.php' does not exist!");
		}

		foreach($this->controller->getData() as $key=>$value) {
			$$key = $value;
		}
		if(strpos($tpl, 'ajax_') !== false){
			include  "$innerTpl";;
		}
		else{
			$ct = $this->controller->getTitle();
			$title = "MVC" . ($ct ? " - ".$ct : "");
			include  __DIR__ ."/templates/main.php";;
		}
	}
}
