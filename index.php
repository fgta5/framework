<?php
require_once __DIR__ . '/vendor/autoload.php';

use AgungDhewe\Webservice\Configuration;
use AgungDhewe\Webservice\Service;

use AgungDhewe\Webservice\Router;
use AgungDhewe\Webservice\Routers\PageRoute;


// script ini hanya dijalankan di web server
if (php_sapi_name() === 'cli') {
	die("Script cannot be executed directly from CLI\n\n");
}

// untuk keperluan debug halaman web
if (getenv('DEBUG')) {
	$urlreq = array_key_exists('urlreq', $_GET) ? trim($_GET['urlreq'], '/') : PageRoute::DEFAULT_PAGE;
	$pattern = "page/*";
	$regexPattern = str_replace('*', '.*', $pattern);
	$regexPattern = str_replace('/', '\/', $regexPattern); // Escape slashes
	if (preg_match("/^$regexPattern$/", $urlreq, $matches)) {
		$_GET['cleardebug'] = 1;
	}
}

try {
	$configfile = 'config.php';
	if (getenv('CONFIG')) {
		$configfile = getenv('CONFIG');
	}

	$configpath = implode('/', [__DIR__, $configfile]);
	if (!is_file($configpath)) {
		throw new Exception("Configuration '$configfile' is not found");
	}

	require_once $configpath;
	Configuration::setRootDir(__DIR__);
	Configuration::setLogger();

	// Route internal
	Router::setupDefaultRoutes();

	// Route external: akan menggunakan format PSR4
	Router::GET('module/asset/*', 'AgungDhewe\Webservice\Routers\ModuleAssetRoute');
	Router::GET('module/page/*', 'AgungDhewe\Webservice\Routers\ModulePageRoute');
	Router::POST('module/api/*', 'AgungDhewe\Webservice\Routers\ModuleApiRoute');

	// Serve url
	Service::main();

	echo "\n";
} catch (Exception $ex) {
	Service::handleHttpException($ex);
}