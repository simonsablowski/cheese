<?php

$configuration = array();

$configuration['pathMother'] = 'D:/Webprojekte/nacho/';

$configuration['pathApplication'] = dirname(__FILE__) . '/';

$configuration['basePath'] = '/cheese/web/';

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

$configuration['defaultQuery'] = 'Food/index';

$configuration['aliasQueries'] = array();

$configuration['debugMode'] = TRUE;
// $configuration['debugMode'] = FALSE;