<?php

class Option extends Application {
	protected $name = NULL;
	protected $label = NULL;
	protected $default = FALSE;
	
	public function __construct($name, $label, $default = FALSE) {
		$this->setName($name);
		$this->setLabel($label);
		$this->setDefault($default);
	}
}