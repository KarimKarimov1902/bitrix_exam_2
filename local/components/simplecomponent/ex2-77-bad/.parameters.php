<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
	
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "STRING",
		),

		"IBLOCK_CLASSIFIER_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_CLASSIFIER_ID"),
			"TYPE" => "STRING",
		),
			
		"CLASSIFIER_PROP_CODE" => array(
				"PARENT" => "BASE",
				"NAME" => GetMessage("T_IBLOCK_DESC_CLASSIFIER_PROP_CODE"),
				"TYPE" => "STRING",
		),
			
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),

	),
);

