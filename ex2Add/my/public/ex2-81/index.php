<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-81");
?><h3>
[ex2-81] Внести доработки в созданный простой компонент «Каталог товаров» <br>
 </h3>
 &nbsp;В .parameters.php добавляем пункт: <br>
 <br>
 <span style="color: #00aeef; font-family: Courier New;">"TEMPLATE_DETAIL_URL" =&gt; array( </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "PARENT" =&gt; "BASE", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "NAME" =&gt; GetMessage("TEMPLATE_DETAIL_URL"), </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "TYPE" =&gt; "STRING", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "MULTIPLE" =&gt; "N", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "DEFAULT" =&gt; "/catalog_exam/#SECTION_ID#/#ELEMENT_CODE#", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
), </span><br>
 <br>
 В /lang/ru/.parameters.php добавляем: <br>
 <br>
 <span style="color: #00aeef; font-family: Courier New;">$MESS['TEMPLATE_DETAIL_URL'] = 'Шаблон ссылки на детальный просмотр'; </span> <br>
 <br>
 Остальная магия в component.php и template.php.<br>
 <br>
 Для наглядности, можно в ИБ Продукция: Товары задать символьный код.<br>
<br>
Открыть настройки параметров компонента и нажать сохранить, для пересохранения.<br>
<h4><span style="color: #00a650;">Вот и сам компонент:</span></h4>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-81_71",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"FIRMS_IBLOCK_ID" => "7",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_FIRMS_CODE" => "COMPANY_MULTY",
		"TEMPLATE_DETAIL_URL" => "/catalog_exam/#SECTION_ID#/#ELEMENT_CODE#"
	)
);?>
<h4></h4><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>