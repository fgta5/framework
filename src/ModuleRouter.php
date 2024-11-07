<?php namespace Fgta5\Framework;

use AgungDhewe\Webservice\Router;

use Fgta5\Framework\Routes\ModuleAssetRoute;
use Fgta5\Framework\Routes\ModulePageRoute;
use Fgta5\Framework\Routes\ModuleApiRoute;

class ModuleRouter {

	public static function setupModuleRoutes() : void {
		Router::GET('module/asset/*', ModuleAssetRoute::class);
		Router::GET('module/page/*', ModulePageRoute::class);
		Router::POST('module/api/*', ModuleApiRoute::class);
	
	}

}