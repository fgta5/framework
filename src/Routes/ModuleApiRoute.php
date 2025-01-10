<?php namespace Fgta5\Framework\Routes;

use AgungDhewe\Webservice\IRouteHandler;
use AgungDhewe\Webservice\ServiceRoute;

class ModuleApiRoute extends ServiceRoute implements IRouteHandler {
	function __construct(string $urlreq) {
		parent::__construct($urlreq); // contruct dulu parentnya
	}

	public function route(?array $param = []) : void {
	}

}