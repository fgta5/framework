<?php namespace Fgta5\Framework\Routes;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\Configuration;
use AgungDhewe\Webservice\IRouteHandler;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\Routes\AssetRoute;


class ModuleAssetRoute extends AssetRoute implements IRouteHandler {
	function __construct(string $urlreq) {
		parent::__construct($urlreq); // contruct dulu parentnya
	}

	public function route(?array $param = []) : void {
		Log::Info("Route Module Asset $this->urlreq");

		try {

			$requestedAsset = ServiceRoute::GetRequestedParameter('module/asset/', $this->urlreq);

			$parts = explode('/', $requestedAsset);
			$firstTwo = implode('/', array_slice($parts, 0, 2));
			$remaining = implode('/', array_slice($parts, 2));
			$assetpath = join('/', [strtolower($firstTwo), 'src', $remaining]);
			Log::Info("assetpath: $assetpath");

			$dir = join(DIRECTORY_SEPARATOR, [Configuration::GetRootDir(), 'vendor']);

			$this->sendAsset($dir, $assetpath);

		} catch (\Exception $ex) {
			throw $ex;
		}
	}

}