<?php namespace Fgta5\Framework;

interface IModulePage {
	static function GetModulePagePath(string $modulePageClass) : string;

	function LoadPage(string $requestedModulePageClass, array $params) : void;
	function GetTemplate(?array $param = []) : object;
	function getData() : array;
	function getTitle() : string;

}