<?php

class PasswordField extends Field {
	public function __construct($name = 'password', $label = 'Password') {
		$this->setName($name);
		$this->setLabel($label);
	}
}