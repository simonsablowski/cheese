<?php

class AuthenticationController extends Controller {
	protected $User;
	
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new TextField('userName', 'User Name', 100);
		
		$Fields[] = new PasswordField('password', 'Password', 40);
		
		return $Fields;
	}
	
	public function signIn() {
		if ($this->authenticate()) {
			throw new FatalError('Authenticated', $this->getSession()->getData('User')->getUserName());
		}
		
		if ($this->getConfiguration('basicAuthentication')) {
			$userName = $this->getRequest()->getData('PHP_AUTH_USER');
			$password = $this->getRequest()->getData('PHP_AUTH_PW');
		} else {
			$userName = $this->getRequest()->getData('userName');
			$password = $this->getRequest()->getData('password');
		}
		
		if ($userName && $password) {
			try {
				$this->setUser(User::findByUserNameAndPassword(array(
					$userName,
					sha1($password . $this->getConfiguration('encryptionKey'))
				)));
				$this->getSession()->setData('User', $this->getUser());
				return $this->redirect();
			} catch(Error $Error) {
				throw new FatalError('Unauthorized', $userName);
			}
		} else {
			if ($this->getConfiguration('basicAuthentication')) {
				$realmName = $this->localize($this->getConfiguration('pageTitle'));
				header(sprintf('WWW-Authenticate: Basic realm="%s"', $realmName));
				header('HTTP/1.0 401 Authorization Required');
			} else {
				return $this->displayView('Authentication.signIn.php', array(
					'Fields' => self::getFields(),
					'query' => $this->getRequest()->getConfiguration('defaultQuery')
				));
			}
		}
	}
	
	public function signOut() {
		$this->setUser(NULL);
		$this->getSession()->setData('User', $this->getUser());
		return $this->redirect();
	}
	
	protected function authenticate() {
		return $this->getSession()->getData('User') instanceof User;
	}
	
	protected function performAction($actionName, $parameters) {
		if ($this->authenticate()) {
			return parent::performAction($actionName, $parameters);
		} else {
			return $this->signIn();
		}
	}
}