<?php namespace Fgta5\Framework\Pages;

use AgungDhewe\PhpLogger\Log;

use Fgta5\Framework\IModulePage;
use Fgta5\Framework\ModulePage;

class TestPage extends ModulePage implements IModulePage {
	public function LoadPage(array $params): void {
		try {

			$this->setTitle("Judul Module");

			$pageviewpath = implode(DIRECTORY_SEPARATOR, [__DIR__, 'TestPage.phtml']);
			$this->render($pageviewpath);
		} catch (\Exception $ex) {
			Log::error($ex->getMessage());
			throw $ex;
		}
	}
	
}
