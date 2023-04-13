<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-96");
?><h3>
[ex2-96] Разработать простой компонент «Избранные товары» </h3>
 Создаем свойство в информационном блоке Продукция:<br>
 название - <b>В избранном у пользователей</b>;<br>
 тип – <b>привязка к пользователям</b>;<br>
 код - <b>USERFAVOR</b><br>
 <br>
 Создаем двух тестовых пользователей с логинами test1 и test2.<br>
 <br>
 Для товаров из раздела Мягкая мебель задаем пользователей для нашего свойства:<br>
 <img src="/upload/medialibrary/857/85777aa5cd6c0f2e70f6cb5d28ca241e.png"><br>
<br>
<h4><span style="color: #00a650;">Сам компонент:</span></h4>
 <br>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-96",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CLASSIFIER_PROP_CODE" => "UF_LINK_SECTION_SING",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "2",
		"PRODUCTS_IBLOCK_ID" => "2",
		"PROP_CODE" => "USERFAVOR"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>