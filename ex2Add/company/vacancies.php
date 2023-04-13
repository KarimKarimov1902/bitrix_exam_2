<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?><?$APPLICATION->IncludeComponent("bitrix:furniture.vacancies", "ex2-41", Array(
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"IBLOCK_ID" => "4",	// Список инфоблоков
		"IBLOCK_TYPE" => "vacancies",	// Типы инфоблоков
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>