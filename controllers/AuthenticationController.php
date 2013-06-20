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
		
		$userName = $this->getRequest()->getData('userName');
		$password = $this->getRequest()->getData('password');
		
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
			return $this->displayView('Authentication.signIn.php', array(
				'Fields' => self::getFields()
			));
		}
	}
	
	public function signOut() {
		$this->setUser(NULL);
		$this->getSession()->setData('User', $this->getUser());
		return $this->redirect($this->getRequest()->getConfiguration('defaultQuery'));
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