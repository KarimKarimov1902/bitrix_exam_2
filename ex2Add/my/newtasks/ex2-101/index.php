<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-101");
?><h3>[ex2-101] Добавить пункт «Hello world» в меню компонента.</h3>
<div>
	<br>
</div>
<div>
	Весь код находится в component.php.<br>
</div>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-101_70",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_NEWS_CODE" => "UF_NEWS_LINK"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>