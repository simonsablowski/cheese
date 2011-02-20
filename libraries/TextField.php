<?php

class TextField extends Field {
	protected $length = NULL;
	
	public function __construct($name, $label, $length = NULL) {
		$this->setName($name);
		$this->setLabel($label);
		if (!is_null($length)) $this->setLength($length);
	}
}