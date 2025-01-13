<?php declare(strict_types=1);
namespace Fgta5\Framework\Routes;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\Configuration;
use AgungDhewe\Webservice\IRouteHandler;
use AgungDhewe\Webservice\Routes\PageRoute;
use AgungDhewe\Webservice\Database;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\Session;
use AgungDhewe\Webservice\WebTemplate;
use AgungDhewe\Webservice\IWebTemplate;

use Fgta5\Framework\IModulePage;
use Fgta5\Framework\ModulePage;


class ModulePageRoute extends PageRoute implements IRouteHandler {
	function __construct(string $urlreq) {
		parent::__construct($urlreq); // contruct dulu parentnya
	}


	// #[Override]
	public function route(?array $param = []) : void {
		Log::Info("Route Module Page $this->urlreq");

		if (array_key_exists('httpheader', $param)) {
			$httpheader = $param['httpheader'];
			header($httpheader);
		}

		try {

			// Koneksi database
			Database::Connect();
			Session::Start();

			// modul applikasi yang di request user
			$requestedModulePageClass = ServiceRoute::getRequestedParameter('module/page/', $this->urlreq);

			// Cek apakah sudah login
			/*
			if (! Session::IsLoggedIn()) {
				Log::Info('User not logged in, redirect to login page');
				$loginPageClass = Configuration::Get('LoginPage');
				if (empty($loginPageClass)) {
					$requestedModulePageClass = 'Fgta5/Framework/Login/LoginPage';
				} else {
					$requestedModulePageClass = $loginPageClass;
				}

			}
			*/

			
			$modulePageClass = str_replace('/', '\\', $requestedModulePageClass);
			Log::Info("loading class: $modulePageClass");	
			if (!class_exists($modulePageClass)) {
				$errmsg = Log::Error("Class Module for requested url '$requestedModulePageClass' is not exists");
				throw new \Exception($errmsg, 500);
			}

			// cek apakah modulePageClass subclass dari ModulePage
			if (!is_subclass_of($modulePageClass, ModulePage::class)) {
				$errmsg = Log::Error("Class '$modulePageClass' not subclass of ModulePage");
				throw new \Exception($errmsg, 500);
			}

			$module = self::createModule($modulePageClass, $param);
			$tpl = $module->getTemplate(['modulepageclass'=>$modulePageClass]);

			// Validasi Template
			if (!is_subclass_of($tpl, WebTemplate::class)) {
				$tplclassname = get_class($tpl);
				$errmsg = Log::Error("Class '$tplclassname' not subclass of WebTemplate");
				throw new \Exception($errmsg, 500);
			}

			if (!in_array(IWebTemplate::class, class_implements($tpl))) {
				$tplclassname = get_class($tpl);
				$errmsg = Log::Error("Class '$tplclassname' not implements IWebTemplate");
				throw new \Exception($errmsg, 500);
			}


			$content = "";
			try {
				self::SetTemplate($tpl);
				ob_start();
				
				$module->loadPage($requestedModulePageClass, $param);
				$data = $module->getPageData();
				self::SetPageData($data);

				$title = $module->getTitle();
				$tpl->setTitle($title);

				$content = ob_get_contents();
			} catch (\Exception $ex) {
				$errmsg = Log::Error($ex->getMessage());
				throw new \Exception($errmsg, $ex->getCode());
			} finally {
				ob_end_clean();
			}


			$tpl->Render($content);
		
		} catch (\Exception $ex) {
			throw $ex;
		}

	}


	private static function createModule(string $modulePageClass, ?array $param) : IModulePage {
		$module = new $modulePageClass($param);
		return $module;
	}


}