<?php

class FoodController extends CmsController {
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new TextField('title', 'Title');
		
		$Options = array();
		$Options[] = new Option('active', 'Active', TRUE);
		$Options[] = new Option('deleted', 'Deleted');
		$Fields[] = new OptionsField('status', 'Status', $Options);
		
		return $Fields;
	}
}