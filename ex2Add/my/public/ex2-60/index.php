<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-60");
?><h3>
[ex2-60] Добавить постраничную навигацию в созданный простой компонент </h3>
<p>
</p>
<h4>
<div>
	 Для задания [ex2-71].
</div>
 </h4>
<div>
	 В .parameters.php добавляем: <br>
</div>
<div>
 <br>
</div>
<div>
 <span style="color: #00aeef; font-family: Courier New;">"ELEMENTS_PER_PAGE" =&gt; array( </span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">"PARENT" =&gt; "BASE", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp; "NAME" =&gt; GetMessage("ELEMENTS_PER_PAGE"), </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp; "TYPE" =&gt; "STRING", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp; "DEFAULT" =&gt; "2" </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	), </span>
</div>
 <br>
<p>
</p>
<div>
	 В лэнговый .parameters.php добавляем <br>
</div>
<div>
 <br>
 <span style="color: #00aeef; font-family: Courier New;">
	$MESS["ELEMENTS_PER_PAGE"] = "Элементов на странице"; <br>
 </span>
</div>
<div>
 <span style="color: #00aeef; font-family: Courier New;"><br>
 </span>
</div>
<div>
 <span style="font-family: Courier New;">Остальная магия в component.php и template.php</span><span style="color: #00aeef; font-family: Courier New;"><br>
 </span>
</div>
<div>
 <span style="color: #00aeef; font-family: Courier New;"><br>
 </span>
</div>
<h4><span style="color: #00aeef; font-family: Courier New;"><b><span style="color: #00a650;">Собственно, сам компонент:</span></b></span></h4>
<div>
	 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-60_71",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"ELEMENTS_PER_PAGE" => "2",
		"FIRMS_IBLOCK_ID" => "7",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_FIRMS_CODE" => "COMPANY_MULTY"
	)
);?>
</div>
<p>
</p>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>