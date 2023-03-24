<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"SET_SPECIALDATE" => Array(
		"NAME" => GetMessage("NAME_SET_SPECIALDATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"IBLOCK_CANONICAL" => Array(
		"NAME" => GetMessage("NAME_IBLOCK_CANONICAL"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SET_AJAX_ZALOB" => Array(
		"NAME" => GetMessage("NAME_AJAX_ZALOB"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	)
);
?>
