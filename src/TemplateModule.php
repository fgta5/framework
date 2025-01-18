<?php declare(strict_types=1);
namespace Fgta5\Framework;



use AgungDhewe\Webservice\IWebTemplate;

class TemplateModule extends TemplateBasic implements IWebTemplate  {
	const string NAME = "moduletemplate";


	public static function getObject(object $tpl) : TemplateModule {
		return $tpl;
	}

	public function getName() : string {
		return self::NAME;
	}

}