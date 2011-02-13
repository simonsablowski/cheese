<?php

class Field extends Application {
	protected $name = NULL;
	protected $label = NULL;
	protected $type = NULL;
	
	public function __construct($name, $label, $type = 'text') {
		$this->setName($name);
		$this->setLabel($label);
		$this->setType($type);
	}
}