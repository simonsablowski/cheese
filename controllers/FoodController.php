<?php

class FoodController extends CmsController {
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new TextField('title', 'Title');
		
		$Fields[] = new OptionsField('status', 'Status', array(
			new Option('active', 'Active', TRUE),
			new Option('deleted', 'Deleted')
		));
		
		return $Fields;
	}
}