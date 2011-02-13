<?php

abstract class CmsController extends Controller {
	protected $MessageHandler = NULL;
	
	abstract public function getFields();
	
	protected function initializeMessageHandler() {
		$this->setMessageHandler(new MessageHandler);
		$this->getMessageHandler()->setSession($this->getSession());
	}
	
	protected function redirect($path = NULL) {
		if (is_null($path)) $path = sprintf('%s/index', $this->getObjectName());
		header(sprintf('Location: %s%s', $this->getConfiguration('basePath'), $path));
	}
	
	protected function getMessageHandler() {
		if (is_null($this->MessageHandler)) $this->initializeMessageHandler();
		return $this->MessageHandler;
	}
	
	protected function getObjectName() {
		return strstr($this->getClassName(), 'Controller', TRUE);
	}
	
	protected function findObjects() {
		$ObjectName = $this->getObjectName();
		return $ObjectName::findAll();
	}
	
	protected function findObject($id) {
		$ObjectName = $this->getObjectName();
		return $ObjectName::find($id);
	}
	
	public function index() {
		$this->displayView('Model.index.php', array(
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
		
		$this->displayView('Model.form.php', array(
			'Fields' => $this->getFields(),
			'ObjectName' => $this->getObjectName(),
			'mode' => 'create'
		));
	}
	
	public function update($id) {
		$Object = $this->findObject($id);
		
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
		
		$this->displayView('Model.form.php', array(
			'Fields' => $this->getFields(),
			'ObjectName' => $this->getObjectName(),
			'Object' => $Object,
			'mode' => 'update'
		));
	}
	
	public function delete($id) {
		$Object = $this->findObject($id);
		
		$Object->delete();
		
		$this->getMessageHandler()->setMessage('The object was deleted successfully.');
		return $this->redirect();
	}
}