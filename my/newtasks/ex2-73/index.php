<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-73");
?><div class="block">
	<h3 class="extremum-click">[ех2-73] Создание комплексного компонента «Моя фотогалерея» (<span class="spanny">свернуть/развернуть</span>)</h3>
	<div class="extremum-slide">
 <b>Общие требования </b><br>
		 • Расширить возможности стандартного комплексного компонента Фотогалерея (photo), добавить в него новую страницу exampage.php и переменные. <br>
		 • <b>Для новой страницы exampage.php реализовать поддержку как ЧПУ так и не ЧПУ режима.</b> <br>
		 • Для решения предоставляются материалы - заготовка компонента, complexcomp.exam- materials. Это компонент photo, с добавленными заглушками в параметрах, созданной страницей exampage.php. Необходимо реализовать логику в файле components и вывод в шаблоне по заданию. <br>
		 • Работу решения продемонстрировать в разделе сайта /ex2/complexcomponent/, добавить пункт в главное меню «Экзомен2», и пункт в левом меню «Комплексный компонент». <br>
 <br>
 <b>Доработка компонента </b><br>
		 • Добавить переменные для построения адреса страницы: <b>PARAM1, PARAM2</b>. <br>
		 • Шаблон адреса по умолчанию для страницы exompoge.php при ЧПУ режиме: «<b>123/456/edit</b>/?PARAM2=<b>789</b>», где <b>123</b> это значение переменой SECTION_ID, <b>456</b> - ELEMENT_ID, <b>edit</b> - PARAM1, <b>789</b> - PARAM2 <br>
		 • Условие, по которому открывается страница exampage.php без ЧПУ режима: заданы значения переменных SECTION_ID, ELEMENT_ID, PARAM1 <br>
		 • В настройках компонента реализовать <br>
		 &nbsp;&nbsp;&nbsp;&nbsp; - Для ЧПУ режима: управление шаблоном адреса страницы exampage.php <br>
		 &nbsp;&nbsp;&nbsp; - Для не ЧПУ режима: управление именами переменных. <br>
 <br>
 <b>Отображение данных </b><br>
		 • Компонент настроить на отображение инфоблока Продукция. <br>
		 • На странице компонента detail.php, перед подключением bitrix:photo.detail вывести ссылку на страницу exampage.php. <br>
		 • Для проверки решения в ссылку подставить значениями переменных. SECTION_ID, ELEMENT_ID- значения определенные комплексным компонентом, PARAM1 = edit, PARAM2 = 789. <br>
		 • Значения можно подставить с помощью str_replace. <br>
		 • На странице exampage.php вывести значение переменных SECTION_ID, ELEMENT_ID, PARAM1, PARАМ2 <br>
 <br>
 <b>Пример вывода (конкретные данные могут отличаться) </b> <br>
 <br>
		 detail:<br>
 <img src="/upload/medialibrary/0b3/0b32155ff5c01a8e2689c0c56356be11.png" height="364" width="431"> <br>
 <br>
		 exampage:<br>
 <img src="/upload/medialibrary/f7f/f7f9ffe8cb50d82c5695364381dca3a9.png" height="289" width="399">
	</div>
</div>
 <br>
<h3 class="extremum-click">РЕШЕНИЕ (<span class="spanny">свернуть/развернуть</span>)</h3>
<div class="extremum-slide">
	 Копируем компонент из материалов. <br>
 <br>
	 В parameters.php добавляем переменые: <br>
 <span style="color: #00aeef; font-family: Courier New;">"VARIABLE_ALIASES" =&gt; Array(<br>
	 &nbsp;&nbsp;&nbsp; "SECTION_ID" =&gt; Array("NAME" =&gt; GetMessage("SECTION_ID_DESC")),<br>
	 &nbsp;&nbsp;&nbsp; "ELEMENT_ID" =&gt; Array("NAME" =&gt; GetMessage("ELEMENT_ID_DESC")),<br>
	 &nbsp;&nbsp;&nbsp; // Раскомментируем:<br>
	 &nbsp;&nbsp;&nbsp; "PARAM1" =&gt; Array("NAME" =&gt; GetMessage("PARAM1")),<br>
	 &nbsp;&nbsp;&nbsp; "PARAM2" =&gt; Array("NAME" =&gt; GetMessage("PARAM2")),<br>
	 ),<br>
	 //добавили новую страницу<br>
	 "exampage" =&gt; array(<br>
	 &nbsp;&nbsp;&nbsp; "NAME" =&gt; GetMessage("EXAM_PAGE"),<br>
	 &nbsp;&nbsp;&nbsp; "DEFAULT" =&gt; "#SECTION_ID#/#ELEMENT_ID#/#PARAM1#/?PARAM2=#PARAM2#",<br>
	 ),&nbsp; </span><br>
 <br>
	 В лэнговый файл parameters.php добавим: <br>
 <span style="color: #00aeef; font-family: Courier New;">$MESS["EXAM_PAGE"] = "Страница экзамена"; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	$MESS["PARAM1"] = "Параметр 1"; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	$MESS["PARAM2"] = "Параметр 2"; </span><br>
 <br>
	 В sections_top.php убираем ссылку на страницу exampage: <br>
 <span style="color: #ff0000;">Удалить!<span style="color: #00aeef; font-family: Courier New;"> </span></span><span style="color: #00aeef; font-family: Courier New;">&lt;?=GetMessage("EXAM_TEXT_LINK_CP_PHOTO")?&gt;&lt;a href="&lt;?//=$url?&gt;"&gt;&lt;?//=$url?&gt;&lt;/a&gt; </span><br>
 <br>
	 В component.php: <br>
	 - в массив $arDefaultUrlTemplates404 добавляем страницу exampage: <br>
 <span style="color: #00aeef; font-family: Courier New;">"exampage" =&gt; "#SECTION_ID#/#ELEMENT_ID#/#PARAM1#/" </span><br>
	 - в $arComponentVariables: <br>
 <span style="color: #00aeef; font-family: Courier New;">"PARAM1", </span><br>
 <span style="color: #00aeef; font-family: Courier New;">"PARAM2", </span><br>
	 В условие, если не ЧПУ, добавим: <br>
 <span style="color: #00aeef; font-family: Courier New;">if(isset($arVariables["PARAM1"])) </span><br>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp; $componentPage = "exampage"; </span><br>
	 и в $arResult: <br>
 <span style="color: #00aeef; font-family: Courier New;">$arResult = array(</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; "FOLDER" =&gt; "",</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; "URL_TEMPLATES" =&gt; Array(</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; "section" =&gt; htmlspecialcharsbx($APPLICATION-&gt;GetCurPage())."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#",</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; "detail" =&gt; htmlspecialcharsbx($APPLICATION-&gt;GetCurPage())."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"."&amp;".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#",</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; "exampage" =&gt; htmlspecialcharsbx($APPLICATION-&gt;GetCurPage())."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"."&amp;".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#"."&amp;".$arVariableAliases["PARAM1"]."=#PARAM1#"."&amp;".$arVariableAliases["PARAM2"]."=#PARAM2#",&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; ),</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; "VARIABLES" =&gt; $arVariables,</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; "ALIASES" =&gt; $arVariableAliases</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	);<br>
 <br>
 </span>
	exampage.php будет такой: <br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?&gt; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&lt;br&gt;SECTION_ID = &lt;?=$arResult["VARIABLES"]["SECTION_ID"]?&gt; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&lt;br&gt;ELEMENT_ID = &lt;?=$arResult["VARIABLES"]["ELEMENT_ID"]?&gt; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&lt;br&gt;PARAM1 = &lt;?=$arResult["VARIABLES"]["PARAM1"]?&gt; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&lt;br&gt;PARAM2 = &lt;?=$arResult["VARIABLES"]["PARAM2"]?&gt; </span><br>
 <br>
	 На страницу детального просмотра (detail.php) добавим ссылку на страницу exampage: <br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;? </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	$url=""; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	$url=str_replace( </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; array("#SECTION_ID#", "#ELEMENT_ID#", "#PARAM1#", "#PARAM2#"), </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; array($arResult["VARIABLES"]["SECTION_ID"], $arResult["VARIABLES"]["ELEMENT_ID"], "edit", "789"), </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["exampage"] </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	); </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	?&gt;Страница экзамена: &lt;a href="&lt;?=$url?&gt;"&gt;&lt;?=$url?&gt;&lt;/a&gt; </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&lt;/br&gt;&lt;/br&gt; </span>
</div>
<h4><span style="color: #00a650;">Собственно, сам компонент:</span></h4>
 <br>
<div>
	 <?$APPLICATION->IncludeComponent(
	"complexcomponent:ex2-73",
	".default",
	Array(
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
		"COMPONENT_TEMPLATE" => ".default",
		"DETAIL_FIELD_CODE" => array(0=>"",1=>"",),
		"DETAIL_PROPERTY_CODE" => array(0=>"",1=>"",),
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "products",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_FIELD_CODE" => array(0=>"",1=>"",),
		"LIST_PROPERTY_CODE" => array(0=>"",1=>"",),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Фотографии",
		"SECTION_COUNT" => "20",
		"SECTION_LINE_ELEMENT_COUNT" => "3",
		"SECTION_PAGE_ELEMENT_COUNT" => "20",
		"SECTION_SORT_FIELD" => "sort",
		"SECTION_SORT_ORDER" => "asc",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_FIELD_CODE" => array(0=>"",1=>"",),
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PROPERTY_CODE" => array(0=>"",1=>"",),
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"VARIABLE_ALIASES" => array("SECTION_ID"=>"SECTION_ID","ELEMENT_ID"=>"ELEMENT_ID","PARAM1"=>"PARAM1","PARAM2"=>"PARAM2",)
	)
);?>
</div>
<div>
 <br>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>