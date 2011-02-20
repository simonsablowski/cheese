<?php

class ObjectController extends CmsController {
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new TextField('type', 'Type', 50);
		
		$Fields[] = new TextField('key', 'Key', 50);
		
		$Fields[] = new JsonEncodedField('properties', 'Properties');
		
		$Fields[] = new TextField('title', 'Title', 255);
		
		$Fields[] = new TextField('description', 'Description');
		
		$Fields[] = new OptionsField('status', 'Status', array(
			new Option('active', 'Active', TRUE),
			new Option('deleted', 'Deleted')
		));
		
		// $Fields[] = new DateField('created', 'Created');
		
		// $Fields[] = new DateField('modified', 'Modified');
		
		return $Fields;
	}
}