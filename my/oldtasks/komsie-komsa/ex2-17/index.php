<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-17");
?><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расширение типовых компонентов - 17");
?><?$APPLICATION->IncludeComponent(
	"bitrix:furniture.vacancies", 
	"ex2-17", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "vacancies",
		"COMPONENT_TEMPLATE" => "ex2-17",
		"POKAZ_COUNT" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>