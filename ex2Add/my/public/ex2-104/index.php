<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-104");
?><h3>
[ex2-104] Сбор жалоб на новости, на AJAX </h3>
<p>
</p>
<div>
	 Создаем ИБ <b>«Жалобы на новости»</b> с пользовательскими свойствами: <br>
	 Пользователь (строка, код - <b>USER_CODE</b>);
</div>
<div>
	 Новость (привязка к элементам<b> (Новости, Новости)</b>, код - <b>NEWS_CODE</b>). <br>
</div>
<div>
 <br>
</div>
<div>
	 Создаем элемент ИБ «Жалобы на новости», например, Жалоба 1. Начало активности – текущая дата/время, Новость – любая, Пользователь – любой. <br>
</div>
<div>
 <br>
</div>
<div>
	 Настроить отображение списка инфоблока в административном разделе, отображать колонки: ID, Начало активности, Пользователь, Новость. <br>
	 &nbsp; <img src="/upload/medialibrary/bf0/bf02346fe4b09d1ba33577f86685b582.png" height="198" width="562"><br>
</div>
<div>
 <br>
</div>
<div>
	 Если нет /local/templates/furniture_pale-blue/components/bitrix/news/, то копируем из /www/bitrix/components/bitrix/news/templates/ и папку .default (которую переименовываем в ex2-104). <br>
</div>
<div>
 <br>
</div>
<div>
	 В массив $arTemplateParameters файла .parameters.php параметр: <br>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp; "REPORT_AJAX" =&gt; Array( </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "NAME" =&gt; GetMessage("REPORT_AJAX"), </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "TYPE" =&gt; "CHECKBOX", </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "DEFAULT" =&gt; "N", </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp; ), <br>
 </span>
</div>
<div>
 <br>
	 Копируем так же языковой файл .parameters.php и добавляем в него <br>
 <span style="font-family: Courier New; color: #00aeef;">$MESS['REPORT_AJAX'] = "Собирать жалобы в режиме AJAX"; </span><br>
</div>
<div>
 <br>
</div>
<div>
	 Создаем файл: /local/templates/furniture_pale-blue/components/bitrix/news/.default/bitrix/news.detail/.default/component_epilog.php <br>
	 В /local/templates/furniture_pale-blue/components/bitrix/news/.default/bitrix/news.detail/.default/template.php между тегами h3 (<span style="color: #00aeef; font-family: Courier New;">&lt;h3&gt;&lt;?=$arResult["NAME"]?&gt;</span><b>СЮДА!</b><span style="color: #00aeef; font-family: Courier New;">&lt;/h3&gt;</span>) вставляем код (см. комменты). <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
	 В файл /local/templates/furniture_pale-blue/components/bitrix/news/.default/detail.php в массив подключения компонента "bitrix:news.detail" добавим параметр: <br>
 <span style="color: #00aeef; font-family: Courier New;">"REPORT_AJAX" =&gt; $arParams['REPORT_AJAX'] </span>
</div>
 <br>
 <b><span style="color: #00a650;">
<h4>Собственно, сам компонент:<br>
</h4>
</span></b>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"ex2-104",
	Array(
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
		"COMPONENT_TEMPLATE" => "ex2-104",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(0=>"",1=>"",),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(0=>"",1=>"",),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(0=>"",1=>"",),
		"LIST_PROPERTY_CODE" => array(0=>"",1=>"",),
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
		"PREVIEW_TRUNCATE_LEN" => "",
		"REPORT_AJAX" => "Y",
		"SEF_FOLDER" => "/my/public/ex2-104/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("news"=>"","section"=>"","detail"=>"#ELEMENT_ID#/",),
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"SPECIALDATE" => "Y",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>