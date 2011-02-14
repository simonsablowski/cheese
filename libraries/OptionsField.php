<?php

class OptionsField extends Field {
	protected $name = NULL;
	protected $label = NULL;
	protected $Options = NULL;
	
	public function __construct($name, $label, $Options = NULL) {
		$this->setName($name);
		$this->setLabel($label);
		if (!is_null($Options)) $this->setOptions($Options);
	}
}