<?php

class ObjectField extends Field {
	protected $getObjectName = NULL;
	protected $modelName = NULL;
	protected $titleField = NULL;
	protected $primaryKey = NULL;
	
	public function __construct($name, $label, $modelName = NULL, $titleField = 'title') {
		$this->setName($name);
		$this->setLabel($label);
		$this->setGetObjectName('get' . ($objectName = strstr($name, 'Id', TRUE)));
		$modelName = $this->setModelName(!is_null($modelName) ? $modelName : $objectName);
		$this->setTitleField($titleField);
		$this->setPrimaryKey(class_exists($modelName) ? $modelName::getPrimaryKey() : 'id');
	}
}