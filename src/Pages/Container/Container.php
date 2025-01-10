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
			/* 
			dari Container.php, kita tidak perlu merender apapun.
			semua keperluan container dibuat pada templates/containertemplates.phtml
			*/
		} catch (\Exception $ex) {
			Log::error($ex->getMessage());
			throw $ex;
		}
	}
	
}
