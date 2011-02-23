<?php

class CoachingController extends Controller {
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new TextField('key', 'Key', 20);
		
		$Fields[] = new TextField('language', 'Language', 5);
		
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