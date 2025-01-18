<?php declare(strict_types=1);
namespace Fgta5\Framework;


use AgungDhewe\Webservice\IWebTemplate;

class TemplatePlain extends TemplateBasic implements IWebTemplate  {
	const string NAME = "plaintemplate";

	public static function getObject(object $tpl) : TemplatePlain {
		return $tpl;
	}

	public function getName() : string {
		return self::NAME;
	}

}