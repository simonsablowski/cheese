<?php

abstract class AuthenticationController extends Controller {
	protected $User;
	
	protected function signIn($userName, $password) {
		try {
			$this->setUser(User::findByUserNameAndPassword(array(
				$userName,
				sha1($password . $this->getConfiguration('encryptionKey'))
			)));
			return $this->getSession()->setData('User', $this->getUser());
		} catch(Error $Error) {
			return FALSE;
		}
	}
	
	protected function authenticate() {
		if (!is_null($this->getSession()->getData('User'))) {
			return TRUE;
		}
		
		$userName = $this->getRequest()->getData('PHP_AUTH_USER');
		$password = $this->getRequest()->getData('PHP_AUTH_PW');
		
		if ($userName && $password) {
			if ($this->signIn($userName, $password)) {
				return TRUE;
			} else {
				throw new FatalError('Unauthorized', $userName);
			}
		} else {
			$realmName = $this->localize($this->getConfiguration('pageTitle'));
			header(sprintf('WWW-Authenticate: Basic realm="%s"', $realmName));
			header('HTTP/1.0 401 Authorization Required');
		}
	}
	
	protected function performAction($actionName, $parameters) {
		if ($this->authenticate()) {
			return parent::performAction($actionName, $parameters);
		}
	}
}