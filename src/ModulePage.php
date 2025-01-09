<?php namespace Fgta5\Framework;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\WebPage;
use AgungDhewe\Webservice\IWebTemplate;

abstract class ModulePage extends WebPage implements IModulePage {
	protected IWebTemplate $currentTemplate;


	abstract function loadPage(string $requestedModulePageClass, array $params) : void;



	protected function render(string $viewpath, array $PARAMS) : void {
		if (!is_array($PARAMS)) {
			$PARAMS = [];
		}

		try {
			if (!is_file($viewpath)) {
				$errmsg = Log::error("File $viewpath is not found");
				throw new \Exception($errmsg);
			}

			$this->setCurrentPageDir(dirname($viewpath));

			$tpl = $this->getTemplate();
			$page = $this;
			$CONTENTPARAMS = $PARAMS; 

			require_once $viewpath;
		} catch (\Exception $ex) {
			$errmsg = Log::error($ex->getMessage());
			throw new \Exception($errmsg);
		}
	}


	public function getTemplate(?array $param = []) : IWebTemplate {
		if (isset($this->currentTemplate)) {
			return $this->currentTemplate;
		}
		
		$modulepageclass = array_key_exists('modulepageclass', $param) ? $param['modulepageclass'] : '';
		if ($modulepageclass=='Fgta5\Framework\Pages\Container') {
			$this->currentTemplate = new TemplateContainer();
		} else {
			$this->currentTemplate = new TemplateModule();
		}
		return $this->currentTemplate;
	}

	public static function GetModulePagePath(string $modulePageClass) : string {
		$ns = ServiceRoute::getModuleNamespace($modulePageClass);
		$classdir = str_replace($ns . '\\', '', $modulePageClass);
		$classdir = str_replace('\\', '/', $classdir);
		$classname = basename($classdir);
		$path = implode(DIRECTORY_SEPARATOR, [__DIR__, $classdir, "$classname.php"]);
		return $path;
	}

}