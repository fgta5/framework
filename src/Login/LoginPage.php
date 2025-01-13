<?php declare(strict_types=1);
namespace Fgta5\Framework\Login;

use AgungDhewe\PhpLogger\Log;
use Fgta5\Framework\ModulePage;

class LoginPage extends ModulePage  {

	function __construct() {
		$this->setTitle("Login");
		$this->setTemplate(new \Fgta5\Framework\TemplatePlain());
	}

	public static function GetObject(object $obj) : LoginPage {
		return $obj;
	}

	public function loadPage(string $requestedPage, array $params): void {
		try {

			echo "test";
		} catch (\Exception $ex) {
			Log::Error($ex->getMessage());
			throw $ex;
		}
	}
}