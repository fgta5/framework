<?php namespace Fgta5\Framework;


interface IDefaultModule {
	function GetTemplate(?array $param = []) : object;
}