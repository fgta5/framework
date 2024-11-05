<?php namespace Fgta5\Framework;

use AgungDhewe\Webservice\Router;

class ModuleRouter {

	public static function setupModuleRoutes() : void {
		Router::GET('module/asset/*', 'Fgta5\Framework\Routes\ModuleAssetRoute');
		Router::GET('module/page/*', 'Fgta5\Framework\Routes\ModulePageRoute');
		Router::POST('module/api/*', 'Fgta5\Framework\Routes\ModuleApiRoute');
	
	}

}