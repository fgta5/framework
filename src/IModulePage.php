<?php namespace Fgta5\Framework;

interface IModulePage {
	static function GetModulePagePath(string $modulePageClass) : string;

	function LoadPage(string $requestedModulePageClass, array $params) : void;
	function GetTemplate(?array $param = []) : object;
	function getPageData() : array;
	function getData(string $key) : mixed;

	function getTitle() : string;

}