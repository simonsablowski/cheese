<?php

$configuration = array();

$configuration['pathApplication'] = dirname(__FILE__) . '/';

$configuration['basePath'] = 'http://localhost/cheese/';

$configuration['includeDirectories'] = array(
	$configuration['pathApplication'],
	'D:/Webprojekte/motivado/api/',
	'D:/Webprojekte/nacho/'
);

$configuration['Database'] = array(
	'type' => 'MySql',
	'host' => 'localhost',
	// 'name' => 'cheese',
	'name' => 'motivado_api',
	'user' => 'root',
	'password' => ''
);

$configuration['Localization'] = array(
	'default' => 'de_DE',
	'de_DE' => array(
		'language' => 'de_DE',
		'locale' => 'de_DE'
	)
);

$configuration['Request'] = array(
	// 'defaultQuery' => 'Food/index',
	'defaultQuery' => 'Object/index',
	'aliasQueries' => array()
);

$configuration['debugMode'] = TRUE;
// $configuration['debugMode'] = FALSE;