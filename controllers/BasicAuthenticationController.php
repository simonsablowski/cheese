<?php

class BasicAuthenticationController extends AuthenticationController {
	public function signIn() {
		if ($this->authenticate()) {
			throw new FatalError('Authenticated', $this->getSession()->getData('User')->getUserName());
		}
		
		$userName = $this->getRequest()->getData('PHP_AUTH_USER');
		$password = $this->getRequest()->getData('PHP_AUTH_PW');
		
		if ($userName && $password) {
			try {
				$this->setUser(User::findByUserNameAndPassword(array(
					$userName,
					sha1($password . $this->getConfiguration('encryptionKey'))
				)));
				$this->getSession()->setData('User', $this->getUser());
				return $this->redirect($this->getRequest()->getConfiguration('defaultQuery'));
			} catch(Error $Error) {
				throw new FatalError('Unauthorized', $userName);
			}
		} else {
			$realmName = $this->localize($this->getConfiguration('pageTitle'));
			header(sprintf('WWW-Authenticate: Basic realm="%s"', $realmName));
			header('HTTP/1.0 401 Authorization Required');
		}
	}
}