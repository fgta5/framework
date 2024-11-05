<?php namespace Fgta5\Framework;

use AgungDhewe\Webservice\WebTemplate;

class ModulePage implements IDefaultModule {
	public function GetTemplate(?array $param = []) : object {
		$modulepageclass = array_key_exists('modulepageclass', $param) ? $param['modulepageclass'] : '';
		if ($modulepageclass=='Fgta5\Framework\Pages\Container') {
			return new TemplateContainer();
		} else {
			return new TemplateModule();
		}
	}
}