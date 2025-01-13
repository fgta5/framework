<?php declare(strict_types=1);
namespace Fgta5\Framework\Container;

use AgungDhewe\PhpLogger\Log;
use Fgta5\Framework\ModulePage;


class ContainerPage extends ModulePage {

	function __construct() {
		$this->setTitle("Container");
		$this->setTemplate(new \Fgta5\Framework\TemplateContainer());
	}


	public static function GetObject(object $obj) : ContainerPage {
		return $obj;
	}

	public function loadPage(string $requestedPage, array $params): void {
		try {
			//$this->setTitle("Container");
			/* 
			dari Container.php, kita tidak perlu merender apapun.
			semua keperluan container dibuat pada templates/containertemplates.phtml
			*/


			/* Cek apakah sudah login */
			
		} catch (\Exception $ex) {
			Log::Error($ex->getMessage());
			throw $ex;
		}
	}
	
}
