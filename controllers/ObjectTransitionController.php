<?php

class ObjectTransitionController extends CmsController {
	public function getFields() {
		$Fields = array();
		
		$Fields[] = new ObjectField('CoachingId', 'Coaching');
		
		$Fields[] = new ObjectField('LeftId', 'Left Object', 'Object');
		
		$Fields[] = new ObjectField('RightId', 'Right Object', 'Object');
		
		$Fields[] = new TextField('condition', 'Condition', 255);
		
		$Fields[] = new OptionsField('status', 'Status', array(
			new Option('active', 'Active', TRUE),
			new Option('deleted', 'Deleted')
		));
		
		// $Fields[] = new DateField('created', 'Created');
		
		// $Fields[] = new DateField('modified', 'Modified');
		
		return $Fields;
	}
}