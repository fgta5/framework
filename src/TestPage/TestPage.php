<?php namespace Fgta5\Framework\TestPage;

use AgungDhewe\PhpLogger\Log;

use Fgta5\Framework\ModulePage;

class TestPage extends ModulePage {
	public static function GetObject(object $obj) : TestPage {
		return $obj;
	}

	public function LoadPage(string $requestedPage, array $params): void {
		try {

			$this->setTitle("Judul Module");
			$pageviewpath = implode(DIRECTORY_SEPARATOR, [__DIR__, 'TestPage.phtml']);
			Log::Info("rendering file $pageviewpath");
			$this->renderPageFile($pageviewpath, $params);
		} catch (\Exception $ex) {
			Log::Error($ex->getMessage());
			throw $ex;
		}
	}
	
}
