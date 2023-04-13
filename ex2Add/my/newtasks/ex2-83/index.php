<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-83");
?><h3>[ех2-83] Добавить постраничную навигацию в созданный простой компонент</h3>
 Если задание <b>[ex2-70]</b>:<br>
<br>
 <b>Настраиваем параметры</b>: <br>
 ID ИБ товаров – <b>2</b>; <br>
 ID ИБ новостей – <b>1</b>; <br>
 Количество элементов на странице - <b>2</b> (любое!);<br>
 Код пользовательского свойства разделов каталога - <b>UF_NEWS_LINK</b>. <br>
<hr>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-83_70",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_ELS" => "2",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_NEWS_CODE" => "UF_NEWS_LINK"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>