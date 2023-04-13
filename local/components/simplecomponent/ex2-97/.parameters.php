<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
        "NEWS_IBLOCK_ID" => array(
            "NAME" => GetMessage("NEWS_IBLOCK_ID"),
            "TYPE" => "STRING",
        ),
        "PROPERTY_AUTHOR_CODE" => array(
            "NAME" => GetMessage("PROPERTY_AUTHOR_CODE"),
            "TYPE" => "STRING",
        ),
        "FIELD_AUTHOR_CODE" => array(
            "NAME" => GetMessage("FIELD_AUTHOR_CODE"),
            "TYPE" => "STRING",
        ),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BNL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);