<?php

abstract class Controller extends Application {
	protected $MessageHandler = NULL;
	
	public function __construct() {
		
	}
	
	protected function performAction($actionName, $parameters) {
		if (!$this->hasMethod($actionName) || !$this->getMethod($actionName)->isPublic()) {
			throw new FatalError('Invalid action', array('Controller' => $this->getClassName(), 'Action' => $actionName, 'Parameters' => $parameters));
		}
		
		if (count($this->getMethod($actionName)->getParameters()) > count($parameters)) {
			throw new FatalError('Missing parameters', array('Controller' => $this->getClassName(), 'Action' => $actionName, 'Parameters' => $parameters));
		}
		
		if ($this->hasMethod('autoload')) {
			spl_autoload_register(array($this, 'autoload'));
		}
		
		call_user_func_array(array($this, $actionName), $parameters);
		
		$this->getOutputBuffer()->flush();
	}
	
	abstract public function getFields();
	
	protected function redirect($path = NULL) {
		if (is_null($path)) $path = sprintf('%s/index', $this->getObjectName());
		header(sprintf('Location: %s%s', $this->getConfiguration('basePath'), $path));
	}
	
	protected function setupMessageHandler() {
		$this->setMessageHandler(new MessageHandler);
		$this->getMessageHandler()->setSession($this->getSession());
	}
	
	protected function getMessageHandler() {
		if (is_null($this->MessageHandler)) $this->setupMessageHandler();
		return $this->MessageHandler;
	}
	
	protected function getObjectName() {
		return strstr($this->getClassName(), 'Controller', TRUE);
	}
	
	protected function findObjects() {
		$ObjectName = $this->getObjectName();
		return $ObjectName::findAll();
	}
	
	protected function findObject($primaryKeyValue) {
		$ObjectName = $this->getObjectName();
		$primaryKey = is_array($ObjectName::getPrimaryKey()) ? $ObjectName::getPrimaryKey() : array($ObjectName::getPrimaryKey());
		return $ObjectName::find(array_combine($primaryKey, $primaryKeyValue));
	}
	
	protected function getViewFile($function) {
		if (!$this->isView($view = sprintf('%s.%s.php', $this->getObjectName(), $function))) {
			$view = sprintf('Model.%s.php', $function);
		}
		
		return $view;
	}
	
	public function index() {
		$this->displayView($this->getViewFile('index'), array(
			'message' => $this->getMessageHandler()->getMessage(),
			'Fields' => $this->getFields(),
			'ObjectName' => $this->getObjectName(),
			'Objects' => $this->findObjects()
		));
	}
	
	public function create() {
		if ($this->getRequest()->isSubmitted()) {
			$ObjectName = $this->getObjectName();
			
			$Object = new $ObjectName($this->getRequest()->getData());
			$Object->create();
			
			$this->getMessageHandler()->setMessage('The object was created successfully.');
			return $this->redirect();
		}
		
		$this->displayView($this->getViewFile('form'), array(
			'Fields' => $this->getFields(),
			'ObjectName' => $this->getObjectName(),
			'mode' => 'create'
		));
	}
	
	public function update() {
		$Object = $this->findObject(func_get_args());
		
		if ($this->getRequest()->isSubmitted()) {
			$validFields = array_keys($Object->getData());
			foreach ($this->getRequest()->getData() as $field => $value) {
				if (in_array($field, $validFields)) {
					$Object->setData($field, $value);
				}
			}
			$Object->update();
			
			$this->getMessageHandler()->setMessage('The object was updated successfully.');
			return $this->redirect();
		}
		
		$this->displayView($this->getViewFile('form'), array(
			'Fields' => $this->getFields(),
			'ObjectName' => $this->getObjectName(),
			'Object' => $Object,
			'mode' => 'update'
		));
	}
	
	public function delete() {
		$Object = $this->findObject(func_get_args());
		
		$Object->delete();
		
		$this->getMessageHandler()->setMessage('The object was deleted successfully.');
		return $this->redirect();
	}
}