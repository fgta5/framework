<?php declare(strict_types=1);
namespace Fgta5\Framework;

use AgungDhewe\Webservice\IWebTemplate;

class TemplateContainer extends TemplateBasic implements IWebTemplate {
	const string NAME = "containertemplate";

	public static function getObject(object $tpl) : TemplateContainer {
		return $tpl;
	}

	public function getName() : string {
		return self::NAME;
	}

}