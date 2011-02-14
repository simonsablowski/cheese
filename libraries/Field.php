<?php

abstract class Field extends Application {
	protected $name = NULL;
	protected $label = NULL;
	
	public function __construct($name, $label) {
		$this->setName($name);
		$this->setLabel($label);
	}
}