<?php declare(strict_types=1);
namespace Fgta5\Framework;

use AgungDhewe\Webservice\WebTemplate;
use AgungDhewe\Webservice\Configuration;
use AgungDhewe\Webservice\IWebTemplate;

class TemplatePage extends WebTemplate implements IWebTemplate  {
	const string NAME = "pagetemplate";

	public static function getObject(object $tpl) : TemplatePage {
		return $tpl;
	}

	public function getName() : string {
		return self::NAME;
	}

	public function getTemplateDir() : string {
		$name = $this->GetName();
		$rootDir = Configuration::getRootDir();
		$templatedir = implode(DIRECTORY_SEPARATOR, [$rootDir, 'templates', $name]);
		if (is_dir($templatedir)) {
			return $templatedir;
		} else {
			$templatedir = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'templates']);
			return $templatedir;
		}
	}



}