<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-50");
?><h3> <b>[ex2-50] Проверка при деактивации товара </b></h3>
<p>
</p>
<p>
</p>
<div>
	 В папке local создаем папку php_interface и в ней файл init.php с кодом: <br>
</div>
 <br>
 <br>
<div>
 <span style="color: #00aeef; font-family: Courier New;">if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php"))<br>
	 &nbsp;&nbsp;&nbsp; require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php");<br>
 <br>
	 if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php"))<br>
	 &nbsp;&nbsp;&nbsp; require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php");</span><br>
</div>
 <br>
 <br>
<div>
	 В подключаемых файлах располагаем код, в handlers.php: <br>
</div>
<div>
 <span style="font-family: Courier New; color: #00aeef;">&lt;?</span>
</div>
<div>
 <span style="font-family: Courier New; color: #00aeef;">use \Bitrix\Main\Localization\Loc;</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	Loc::LoadMessages(__FILE__);</span><br>
 <span style="font-family: Courier New; color: #00aeef;"> </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ExamHandlers", "OnBeforeIBlockElementUpdateHandler"));</span><br>
 <span style="font-family: Courier New; color: #00aeef;"> </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	class ExamHandlers</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	{</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp; function OnBeforeIBlockElementUpdateHandler(&amp;$arFields)</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp; {</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; if(($arFields["ACTIVE"] == "N") &amp;&amp; ($arFields["IBLOCK_ID"] == CATALOG_ID)){</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r = CIBlockElement::GetByID($arFields['ID']);</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if($res = $r -&gt; Fetch()){</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $show_counter = $res['SHOW_COUNTER'];</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if($show_counter &gt; SHOW_COUNTER_VALUE){</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; global $APPLICATION;</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $APPLICATION-&gt;throwException(Loc::getMessage('SHOW_COUNTER_ERROR_1').$show_counter.Loc::getMessage('SHOW_COUNTER_ERROR_2'));</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return false;</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; }</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	}</span>
</div>
<div>
 <br>
	 В constants.php: <br>
 <span style="font-family: Courier New; color: #00aeef;">&lt;? </span><br>
	<span style="font-family: Courier New; color: #00aeef;">&nbsp; define("NEWS_ID", 1);</span>
</div>
<span style="font-family: Courier New; color: #00aeef;">&nbsp; define("CATALOG_ID", 2);</span><span style="font-family: Courier New; color: #00aeef;">&nbsp; </span><br>
<div>
	&nbsp;&nbsp;&nbsp; <span style="font-family: Courier New; color: #00aeef;">define("SHOW_COUNTER_VALUE", 2);</span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	?&gt; </span><br>
	 Создадим папку lang/ru с файлом deactivat.php: <br>
 <span style="font-family: Courier New; color: #00aeef;">&lt;? </span><br>
 <span style="font-family: Courier New; color: #00aeef;">&nbsp; $MESS["SHOW_COUNTER_ERROR_1"] = "Товар невозможно деактивировать, у него["; </span><br>
 <span style="font-family: Courier New; color: #00aeef;">&nbsp; $MESS["SHOW_COUNTER_ERROR_2"] = "] просмотров"; </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	?&gt; </span>
</div>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>