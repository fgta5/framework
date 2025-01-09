<?php namespace Fgta5\Framework\Routes;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\IRouteHandler;
use AgungDhewe\Webservice\Routes\PageRoute;
use AgungDhewe\Webservice\Database;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\Session;
use AgungDhewe\Webservice\WebTemplate;
use AgungDhewe\Webservice\IWebTemplate;

use Fgta5\Framework\IDefaultModule;
use Fgta5\Framework\IModulePage;
use Fgta5\Framework\ModulePage;


class ModulePrintRoute extends PageRoute implements IRouteHandler {
	function __construct(string $urlreq) {
		parent::__construct($urlreq); // contruct dulu parentnya
	}


	// #[Override]
	public function route(?array $param = []) : void {
		//TODO: implement route untuk proses print

	}


	private static function createModule($modulePageClass) : IModulePage {
		$module = new $modulePageClass();
		return $module;
	}


}