<?php namespace Fgta5\Framework\Pages;

use AgungDhewe\PhpLogger\Log;

use Fgta5\Framework\ModulePage;

class Container extends ModulePage {
	public static function GetModulePageObject(object $obj) : Container {
		return $obj;
	}

	public function loadPage(string $requestedPage, array $params): void {
		try {

			$this->setTitle("Container");
			$pageviewpath = implode(DIRECTORY_SEPARATOR, [__DIR__, 'Container.phtml']);
			Log::info("rendering file $pageviewpath");
			$this->render($pageviewpath, $params);
		} catch (\Exception $ex) {
			Log::error($ex->getMessage());
			throw $ex;
		}
	}
	
}
