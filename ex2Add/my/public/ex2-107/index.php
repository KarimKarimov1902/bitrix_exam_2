<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-107");
?><h3>
[ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги» </h3>
<p>
</p>
<div>
	 В /www/bitrix/php_interface/dbconn.php добавляем константу: <br>
 <span style="color: #00aeef; font-family: Courier New;">define("BX_COMP_MANAGED_CACHE", true); </span>
</div>
<div>
	 В template.php добавим: <br>
 <span style="color: #00aeef; font-family: Courier New;">Метка времени:&lt;?echo time();?&gt;&lt;br&gt; <br>
 </span>
</div>
 <br>
 Ну и в component.php кое-что добавили...<br>
<h4><span style="color: #00a650;">Собственно, вывод компонента:</span></h4>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-107_71", 
	".default", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"FIRMS_IBLOCK_ID" => "7",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_FIRMS_CODE" => "COMPANY_MULTY",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<p>
</p>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>