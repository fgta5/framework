<?php declare(strict_types=1);
namespace Fgta5\Framework;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\WebPage;
use AgungDhewe\Webservice\IWebTemplate;

abstract class ModulePage extends WebPage implements IModulePage {
	protected IWebTemplate $currentTemplate;


	public function getTemplate(?array $param = []) : IWebTemplate {
		if (isset($this->currentTemplate)) {
			return $this->currentTemplate;
		} 

		$this->currentTemplate = new TemplateModule();
		return $this->currentTemplate;
	}

	public function setTemplate(IWebTemplate $tpl) : void {
		$this->currentTemplate = $tpl;
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