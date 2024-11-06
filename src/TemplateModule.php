<?php namespace Fgta5\Framework;

use AgungDhewe\Webservice\WebTemplate;
use AgungDhewe\Webservice\Configuration;


class TemplateModule extends WebTemplate {
	const string NAME = "moduletemplate";

	public function GetName() : string {
		return self::NAME;
	}

	public function GetTemplateDir() : string {
		$name = $this->GetName();
		$rootDir = Configuration::getRootDir();
		$templatedir = implode('/', [$rootDir, 'templates', $name]);
		if (is_dir($templatedir)) {
			return $templatedir;
		} else {
			$templatedir = implode('/', [__DIR__, '..', 'templates']);
			return $templatedir;
		}
	}
}