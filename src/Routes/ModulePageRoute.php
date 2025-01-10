<?php namespace Fgta5\Framework\Routes;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\IRouteHandler;
use AgungDhewe\Webservice\Routes\PageRoute;
use AgungDhewe\Webservice\Database;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\Session;
use AgungDhewe\Webservice\WebTemplate;
use AgungDhewe\Webservice\IWebTemplate;

use Fgta5\Framework\IDefaultModule;
use Fgta5\Framework\IModulePage;
use Fgta5\Framework\ModulePage;


class ModulePageRoute extends PageRoute implements IRouteHandler {
	function __construct(string $urlreq) {
		parent::__construct($urlreq); // contruct dulu parentnya
	}


	// #[Override]
	public function route(?array $param = []) : void {
		Log::info("Route Module Page $this->urlreq");

		if (array_key_exists('httpheader', $param)) {
			$httpheader = $param['httpheader'];
			header($httpheader);
		}

		try {

			// Koneksi database
			Database::Connect();
			Session::Start();
			

			// Cek Class Exists
			$requestedModulePageClass = ServiceRoute::getRequestedParameter('module/page/', $this->urlreq);
			$modulePageClass = str_replace('/', '\\', $requestedModulePageClass);

			// DefaultModulePageClass:  <vendor>\<name>\ModulePage
			$ns = ServiceRoute::getModuleNamespace($modulePageClass);
			$defclass = implode('\\', [$ns, 'ModulePage']);
			// cek apakah Default Class exists
			Log::info("loading class $modulePageClass");	
			if (!class_exists($modulePageClass)) {
				$errmsg = Log::error("Class '$modulePageClass' is not exists");
				throw new \Exception($errmsg, 500);
			}

			
			// cari lokasi $modulePageClass dengan Reflection
			$refl = new ReflectionClass($modulePageClass);


			// loading class, tidak ikut PSR4
			$path = $defclass::GetModulePagePath($modulePageClass);
			if (!is_file($path)) {
				$errmsg = Log::error("File '$path' is not exists");
				throw new \Exception($errmsg, 500);
			}
			require_once $path;

			

			Log::info("loading class $modulePageClass");	
			if (!class_exists($modulePageClass)) {
				$errmsg = Log::error("Class Module '$modulePageClass' is not exists");
				throw new \Exception($errmsg, 500);
			}

			// // cek apakah defaultClass implement IModulePage
			// if (!in_array(IDefaultModule::class, class_implements($defclass))) {
			// 	$errmsg = Log::error("Class '$defclass' not implements IDefaultModule");
			// 	throw new \Exception($errmsg, 500);
			// }

			// // cek apakah modulePageClass implement IModulePage 
			// if (!in_array(IModulePage::class, class_implements($modulePageClass))) {
			// 	$errmsg = Log::error("Class '$modulePageClass' not implements IModulePage");
			// 	throw new \Exception($errmsg, 500);
			// }

			// cek apakah modulePageClass subclass dari ModulePage
			if (!is_subclass_of($modulePageClass, ModulePage::class)) {
				$errmsg = Log::error("Class '$modulePageClass' not subclass of ModulePage");
				throw new \Exception($errmsg, 500);
			}


			$module = self::createModule($modulePageClass);
			$tpl = $module->getTemplate(['modulepageclass'=>$modulePageClass]);
		
			
			// Validasi Template
			if (!is_subclass_of($tpl, WebTemplate::class)) {
				$tplclassname = get_class($tpl);
				$errmsg = Log::error("Class '$tplclassname' not subclass of WebTemplate");
				throw new \Exception($errmsg, 500);
			}

			if (!in_array(IWebTemplate::class, class_implements($tpl))) {
				$tplclassname = get_class($tpl);
				$errmsg = Log::error("Class '$tplclassname' not implements IWebTemplate");
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
				$errmsg = Log::error($ex->getMessage());
				throw new \Exception($errmsg, $ex->getCode());
			} finally {
				ob_end_clean();
			}


			$tpl->Render($content);
		
		} catch (\Exception $ex) {
			throw $ex;
		}

	}


	private static function createModule($modulePageClass) : IModulePage {
		$module = new $modulePageClass();
		return $module;
	}


}