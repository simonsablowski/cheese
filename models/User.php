<?php

class User extends Model {
	protected $fields = array(
		'id',
		'userName',
		'password',
		'status',
		'created',
		'modified'
	);
	protected $requiredFields = array(
		'userName',
		'password'
	);
	protected $hiddenFields = array(
		'id',
		'password',
		'status',
		'created',
		'modified'
	);
}