<?php namespace Fgta5\Framework\Pages;

use Fgta5\Framework\IModulePage;
use Fgta5\Framework\ModulePage;
use Fgta5\Framework\TemplateModule;

class Container extends ModulePage implements IModulePage {
	public function LoadPage(): string {
		return "ini content dari container";
	}
	
}
