<?php

class MessageHandler extends Application {
	public function __construct() {
		
	}
	
	public function getMessage() {
		$message = $this->getSession()->getData('message');
		$this->getSession()->setData('message', NULL);
		return $message;
	}
	
	public function setMessage($message) {
		return $this->getSession()->setData('message', $message);
	}
}