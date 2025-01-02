<?php namespace Fgta5\Framework;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\WebPage;
use AgungDhewe\Webservice\IWebTemplate;

abstract class ModulePage extends WebPage implements IDefaultModule {
	

	public function GetTemplate(?array $param = []) : IWebTemplate {
		$modulepageclass = array_key_exists('modulepageclass', $param) ? $param['modulepageclass'] : '';
		if ($modulepageclass=='Fgta5\Framework\Pages\Container') {
			return new TemplateContainer();
		} else {
			return new TemplateModule();
		}
	}

	protected function render(string $viewpath) : void {
		try {
			if (!is_file($viewpath)) {
				$errmsg = Log::error("File $viewpath is not found");
				throw new \Exception($errmsg);
			}
			require_once $viewpath;
		} catch (\Exception $ex) {
			$errmsg = Log::error($ex->getMessage());
			throw new \Exception($errmsg);
		}
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