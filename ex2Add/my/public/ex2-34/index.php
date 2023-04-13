<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-34");
?><p>
	 Копируем шаблон furniture_pale-blue в папку local.
</p>
<p>
	 В /www/local/templates/furniture_pale-blue/header.php в тег head добавляем:
</p>
<p>
 <span style="font-family: Courier New; color: #00aeef;">&lt;meta property="specialdate" content="&lt;?$APPLICATION-&gt;ShowProperty("specialdate")?&gt;" /&gt; </span>
</p>
<p>
	 Находясь на корневой странице сайта, нажимаем – Изменить раздел -&gt; Свойства раздела. В выпавшем окошке нажимаем «Редактировать свойства папки в Панели управления». Попадаем в Свойства папки Адм. раздела.
</p>
<p>
	 Добавляем код specialdate со значением – 100.
</p>
<p>
	 Из папки /www/bitrix/components/bitrix/news/templates/ копируем в папку /local/templates/furniture_pale-blue/components/bitrix/news/ папку .default. <br>
</p>
<p>
</p>
<p>
	 В .parameters.php, в массив $arTemplateParameters добавляем:
</p>
<p>
	 (После ключа "DISPLAY_PREVIEW_TEXT")
</p>
<p>
</p>
<div>
	<span style="color: #00aeef; font-family: Courier New;">"SPECIALDATE" =&gt; Array( </span><br>
	<span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp; "NAME" =&gt; GetMessage("SPECIALDATE_META_TAG"), </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
	<span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp; "TYPE" =&gt; "CHECKBOX", </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
	<span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp; "DEFAULT" =&gt; "Y", </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
	<span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;">
	),</span>
</div>
<p>
</p>
<p>
</p>
<p>
	 В файле .parameters.php папки lang/ru добавляем параметр:
</p>
<p>
	 $MESS["SPECIALDATE_META_TAG"] = "Установить свойство страницы specialdate";
</p>
<p>
</p>
<p>
	 В файл news.php в массив вызова компонента bitrix:news.list добавляем:
</p>
<p>
	 "SPECIALDATE" =&gt; $arParams["SPECIALDATE"]
</p>
<p>
	 (после ключа "CHECK_DATES" =&gt; $arParams["CHECK_DATES"].
</p>
<p>
</p>
<p>
	 В шаблоне компонента news.list (/www/local/templates/furniture_pale-blue/components/bitrix/news/.default/bitrix/news.list/.default/)
</p>
<p>
	 создаем два файла: component_epilog.php и result_modifier.php.
</p>
<p>
	 В result_modifier.php:
</p>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
if($arParams["SPECIALDATE"] == "Y")</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
{</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp; &nbsp;$arResult['SPECIALDATE'] = $arResult['ITEMS'][0]['ACTIVE_FROM']; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp; &nbsp;$this-&gt;getComponent()-&gt;SetResultCacheKeys(array('SPECIALDATE'));</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
}</span>
<p>
</p>
<p>
	 В component_epilog.php:
</p>
<p>
 <span style="color: #00aeef; font-family: Courier New;">if($arParams['SPECIALDATE'] == 'Y'){ </span>
</p>
 <span style="color: #00aeef; font-family: Courier New;"> </span>
<p>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp; $APPLICATION-&gt;SetPageProperty("specialdate", $arResult['SPECIALDATE']); </span>
</p>
 <span style="color: #00aeef; font-family: Courier New;"> </span>
<p>
 <span style="color: #00aeef; font-family: Courier New;">
	} </span><br>
</p>
<h4> <b>Далее размещаем компонент новостей с дефолтным шаблоном </b><b>для проверки.</b></h4>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	".default", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"POKAZ_COUNT" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"SPECIALDATE" => "Y",
		"USE_SHARE" => "N",
		"VARIABLE_ALIASES" => array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
		)
	),
	false
);?>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>