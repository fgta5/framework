<?php namespace Fgta5\Framework;

interface IModulePage {
	static function GetModulePagePath(string $modulePageClass) : string;
	
	function getTemplate(?array $param = []) : object;
	function loadPage(string $requestedModulePageClass, array $params) : void;
	function getPageData() : array;
	function getData(string $key) : mixed;
	function getTitle() : string;

}