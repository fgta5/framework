<?php

use \AgungDhewe\Webservice\Configuration;
use \AgungDhewe\Webservice\PlainTemplate;


Configuration::Set([
	
	'DbMain' => [
		'DSN' => "mysql:host=127.0.0.1;dbname=tfidblocal",
		'user' => "root",
		'pass' => "rahasia123!"
	],

	'Logger' => [
		'output' => 'none',
		'filename' => 'log.txt',
		'ClearOnStart' => false,
		'debug' => true	
	],

	'WebTemplate' => new PlainTemplate(), 
	'PagesDir' => 'pages',
	// 'BaseUrl' => ''
]);

Configuration::UseConfig([
	Configuration::DB_MAIN => 'DbMain',
]);

