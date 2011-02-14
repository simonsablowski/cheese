<?php

class FoodController extends CmsController {
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new Field('title', 'Title');
		
		$Status = new Field('status', 'Status', 'FieldOptions');
		$FieldOptionsStatus = array();
		$FieldOptionsStatus[] = new FieldOption('active', 'Active', TRUE);
		$FieldOptionsStatus[] = new FieldOption('deleted', 'Deleted');
		$Status->setFieldOptions($FieldOptionsStatus);
		$Fields[] = $Status;
		
		return $Fields;
	}
}