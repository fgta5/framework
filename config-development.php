<?php

use AgungDhewe\Webservice\Configuration;

use Fgta5\Framework\TemplateModule;

Configuration::Setup([
	
	'DbMain' => [
		'DSN' => "mysql:host=127.0.0.1;dbname=tfidblocal",
		'user' => "root",
		'pass' => "rahasia123!"
	],

	'Logger' => [
		'output' => 'file',      			// output ke filename (log.txt)
		'filename' => 'log.txt',			// nama file og
		'maxLogSize' => '10485760',			// ukuran maksimal log (bytes)
		'debug' => true,         			// output ke debug.txt, isi akan dikosongkan apabila ada parameter $_GET['cleardebug'] = 1, atau pada CLI, saat script dijalankan
		'showCallerFileOnInfo' => false,  	// default false, jika true, menampilkan referensi caller file di Log:info()
	],

	'WebTemplate' => new TemplateModule(), 
	'PagesDir' => 'pages',
	// 'BaseUrl' => 'fgta5.localhost',
	
	'IndexPage' => 'module/page/Fgta5/Framework/Pages/Container',
	
]);

Configuration::UseConfig([
	Configuration::DB_MAIN => 'DbMain',
]);

