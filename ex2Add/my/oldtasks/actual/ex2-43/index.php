<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-43");
?><h3>[ех2-43] Изменить «слоган» в шаблоне сайта</h3>
<p>
</p>
<div>
	 В Админке (Настройки - Настройки продукта - Настройки модулей – Управление структурой), во вкладке Настройки для сайтов устанавливаем - <br>
	 "Слоган в шапке сайта" (Тип: slogan_head)
</div>
 <br>
<p>
</p>
<div>
	 В файле /local/templates/furniture_pale-blue/header.php в тег &lt;td id="banner-slogan"&gt; добавляем: <br>
	&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">&lt;?$APPLICATION-&gt;ShowProperty("slogan_head");?&gt;</span>
</div>
 <br>
 В /local/templates/furniture_pale-blue/components/bitrix/catalog/ex2-43/bitrix/catalog.element/.default/result_modifier.php (в самый конец) добавляем:<br>
<div>
 <span style="color: #00aeef; font-family: Courier New;">$arResult["TEXT_FOR_SLOGAN"] = substr($arResult["~PREVIEW_TEXT"],3,50)."...";</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	$obComponent = $this-&gt;GetComponent();</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	$obComponent-&gt;SetResultCacheKeys(array("TEXT_FOR_SLOGAN"));</span>
</div>
 <br>
 /local/templates/furniture_pale-blue/components/bitrix/catalog/ex2-43/bitrix/catalog.element/.default/component_epilog.php станет следующим:<br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp; $APPLICATION-&gt;SetPageProperty("slogan_head", $arResult["TEXT_FOR_SLOGAN"]);</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
?&gt;</span><br>
 <br>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"ex2-43",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "ex2-43",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_PROPERTY_CODE" => array(0=>"",1=>"",),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SHOW_PICTURE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "products",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_PROPERTY_CODE" => array(0=>"",1=>"",),
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_SHOW_PARENT_NAME" => "N",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "Y",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PROPERTY_CODE" => array(0=>"",1=>"",),
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_STORE" => "N",
		"VARIABLE_ALIASES" => array("ELEMENT_ID"=>"ELEMENT_ID","SECTION_ID"=>"SECTION_ID",)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>