<?php namespace Fgta5\Framework\Pages;

use AgungDhewe\PhpLogger\Log;

use Fgta5\Framework\ModulePage;

class TestPage extends ModulePage {
	public static function GetModulePageObject(object $obj) : TestPage {
		return $obj;
	}

	public function LoadPage(string $requestedPage, array $params): void {
		try {

			$this->setTitle("Judul Module");
			$pageviewpath = implode(DIRECTORY_SEPARATOR, [__DIR__, 'TestPage.phtml']);
			Log::info("rendering file $pageviewpath");
			$this->render($pageviewpath, $params);
		} catch (\Exception $ex) {
			Log::error($ex->getMessage());
			throw $ex;
		}
	}
	
}
