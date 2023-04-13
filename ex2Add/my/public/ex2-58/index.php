<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-58");
?><h3>
[ex2-58] Добавить управление элементами – «Эрмитаж» &nbsp;в созданный простой компонент "Каталог товаров" </h3>
<h3><span style="color: #00a650;">Если задание [ex2-70] и Эрмитаж добавлен для элементов ИБ "Новости":</span></h3>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-58_70",
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
);?><br>
 <br>
<h4><span style="color: #00a650;">Если задание [ex2-71] и Эрмитаж добавлен для элементов ИБ "Фирма - производитель":</span></h4>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-58_71",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"FIRMS_IBLOCK_ID" => "7",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_FIRMS_CODE" => "COMPANY_MULTY"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>