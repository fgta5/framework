<?php declare(strict_types=1);
namespace Fgta5\Framework;


use AgungDhewe\Webservice\IWebTemplate;

class TemplatePage extends TemplateBasic implements IWebTemplate  {
	const string NAME = "pagetemplate";

	public static function getObject(object $tpl) : TemplatePage {
		return $tpl;
	}

	public function getName() : string {
		return self::NAME;
	}


}