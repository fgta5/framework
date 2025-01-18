<?php declare(strict_types=1);
namespace Fgta5\Framework;


use AgungDhewe\Webservice\IWebTemplate;

class TemplatePrint extends TemplateBasic implements IWebTemplate  {
	const string NAME = "printtemplate";

	public static function getObject(object $tpl) : TemplatePrint {
		return $tpl;
	}

	public function getName() : string {
		return self::NAME;
	}


}