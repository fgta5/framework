<?php namespace Fgta5\Framework;

use AgungDhewe\PhpLogger\Log;
use AgungDhewe\Webservice\ServiceRoute;
use AgungDhewe\Webservice\WebTemplate;

abstract class ModulePage implements IDefaultModule {
	private string $_title = "";
	private array $_data = [];
	

	protected function setData(array $data) : void {
		$this->_data = $data;
	}

	public function getData() : array {
		return $this->_data;
	}

	protected function setTitle(string $title) : void {
		$this->_title = $title;
	}

	public function getTitle() : string {
		return $this->_title;
	}


	public function GetTemplate(?array $param = []) : object {
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