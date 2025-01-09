<?php
require_once __DIR__ . '/vendor/autoload.php';

use AgungDhewe\PhpLogger\Logger;
use AgungDhewe\Webservice\Configuration;
use AgungDhewe\Webservice\Service;
use AgungDhewe\Webservice\Router;

use Fgta5\Framework\Routes\ModuleAssetRoute;
use Fgta5\Framework\Routes\ModulePageRoute;
use Fgta5\Framework\Routes\ModuleApiRoute;
use Fgta5\Framework\Routes\ModulePrintRoute;


// script ini hanya dijalankan di web server
if (php_sapi_name() === 'cli') {
	die("Script cannot be executed directly from CLI\n\n");
}


try {

	$configfile = 'config-production.php';
	if (getenv('CONFIG')) {
		$configfile = getenv('CONFIG');
	}

	$configpath = implode(DIRECTORY_SEPARATOR, [__DIR__, $configfile]);
	if (!is_file($configpath)) {
		throw new Exception("Configuration '$configfile' is not found");
	}

	require_once $configpath;
	Configuration::SetRootDir(__DIR__);
	Configuration::SetLogger();
	Logger::ShowScriptReferenceToUser(false);


	// Prepare debug
	// PageRoute::ResetDebugOnPageRequest(["page/*", "module/page/*"]);

	// Route internal agungdhewe/webservice
	Router::setupDefaultRoutes();

	// Route external: fgta5framework
	Router::GET('module/asset/*', ModuleAssetRoute::class);
	Router::GET('module/page/*', ModulePageRoute::class);
	Router::POST('module/print/*', ModulePrintRoute::class);
	Router::POST('module/api/*', ModuleApiRoute::class);
	
	// Serve url
	Service::main();

} catch (Exception $ex) {
	Service::handleHttpException($ex);
}