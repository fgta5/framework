<?php namespace Fgta5\Framework;

interface IModulePage {
	public function LoadPage(array $params) : void;
	public static function GetModulePagePath(string $modulePageClass) : string;
}