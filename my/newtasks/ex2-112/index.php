<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-112");
?><?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-112_77",
	"",
	Array(
		"ALTER_IBLOCK_ID" => "12",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CODE_ALTER" => "UF_NEW_CLASSIFIER",
		"PRODUCTS_IBLOCK_ID" => "2"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>