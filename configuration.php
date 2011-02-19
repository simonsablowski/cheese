<?php

$configuration = array();

$configuration['pathMother'] = 'D:/Webprojekte/nacho/';

$configuration['pathApplication'] = dirname(__FILE__) . '/';

$configuration['basePath'] = 'http://localhost/cheese/web/';

$configuration['includeDirectories'] = array(
	$configuration['pathApplication'],
	$configuration['pathMother'] . 'application/',
	$configuration['pathMother'] . 'core/'
);

$configuration['Database'] = array(
	'type' => 'MySql',
	'host' => 'localhost',
	'name' => 'cheese',
	'user' => 'root',
	'password' => ''
);

$configuration['Localization'] = array(
	'language' => 'de_DE',
	'locale' => 'de_DE'
);

$configuration['Request'] = array(
	'defaultQuery' => 'Food/index',
	'aliasQueries' => array()
);

$configuration['debugMode'] = TRUE;
// $configuration['debugMode'] = FALSE;