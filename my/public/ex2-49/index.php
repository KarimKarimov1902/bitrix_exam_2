<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-49");
?><h3>
[ex2-49] Добавить дополнительную фильтрацию элементов в созданный простой компонент «Каталог товаров» </h3>
<h4>Если задание [ex2-70]:</h4>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-48_70",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_NEWS_CODE" => "UF_NEWS_LINK"
	)
);?><br>
<h4>Если задание [ex2-71]:</h4>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-48_71", 
	".default", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_NEWS_CODE" => "COMPANY_MULTY",
		"COMPONENT_TEMPLATE" => ".default",
		"FIRMS_IBLOCK_ID" => "7",
		"PROPERTY_FIRMS_CODE" => "COMPANY_MULTY"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>