<?php namespace Fgta5\Framework\Pages;

use AgungDhewe\PhpLogger\Log;

use Fgta5\Framework\IModulePage;
use Fgta5\Framework\ModulePage;

class Container extends ModulePage implements IModulePage {
	public function LoadPage(array $params): void {
		try {

			$this->setTitle("Container");
			
			$pageviewpath = implode('/', [__DIR__, 'Container.phtml']);
			Log::info("rendering file $pageviewpath");
			$this->render($pageviewpath);
		} catch (\Exception $ex) {
			Log::error($ex->getMessage());
			throw $ex;
		}
	}
	
}