<?php namespace Fgta5\Framework;


interface IDefaultModule {
	static function GetModulePagePath(string $modulePageClass) : string;

	function GetTemplate(?array $param = []) : object;
}