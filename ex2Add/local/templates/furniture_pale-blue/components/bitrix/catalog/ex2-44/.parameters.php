<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DETAIL_SHOW_PICTURE" => Array(
		"NAME" => GetMessage("SHOW_PICTURE_DETAIL"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "Y",
		"PARENT" => 'DETAIL_SETTINGS',
	),
	"SECTION_SHOW_PARENT_NAME" => Array(
		"NAME" => GetMessage("SHOW_PARENT_NAME"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "N",
		"PARENT" => 'ADDITIONAL_SETTINGS',
	),
		
	"SET_META_SPECIANCOUNT" => Array(
		"NAME" => GetMessage("SET_META_SPECIANCOUNT"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "N",
		"PARENT" => 'ADDITIONAL_SETTINGS',
	),
);
?>
