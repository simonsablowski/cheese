<?php

class FoodController extends CmsController {
	public function getFields() {
		$Fields = array();
		$Fields[] = new Field('title', 'Title');
		
		return $Fields;
	}
}