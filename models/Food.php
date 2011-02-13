<?php

class Food extends Model {
	protected $fields = array(
		'id',
		'title',
		'status',
		'created',
		'modified'
	);
	protected $requiredFields = array(
		'title',
	);
	protected $hiddenFields = array(
		'id',
		'status',
		'created',
		'modified'
	);
}