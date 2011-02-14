<?php

class Field extends Application {
	protected $name = NULL;
	protected $label = NULL;
	protected $type = NULL;
	protected $length = NULL;
	
	protected $FieldOptions = array();
	
	public function __construct($name, $label, $type = 'text', $length = '255') {
		$this->setName($name);
		$this->setLabel($label);
		$this->setType($type);
		$this->setLength($length);
	}
}