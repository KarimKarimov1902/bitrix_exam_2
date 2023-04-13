<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-109");
?><h3>
[ех2-109] Изменить фон в шапке <br>
 </h3>
<div>
 <br>
	 В Админке (Настройки - Настройки продукта - Настройки модулей – Управление структурой), во вкладке Настройки для сайтов устанавливаем - "Стиль для фона" (Тип: head_style). <br>
</div>
<div>
 <img src="/upload/medialibrary/7e2/7e27fc535aaae77faeb06fc3b21ab24b.png"> <br>
</div>
<div>
	 Находясь в каталоге Продукция, жмём на Изменить страницу – Заголовок и свойства страницы. В поле Стиль для фона вводим значение - background-color: red;. <br>
</div>
<div>
	<br>
</div>
<div>
	В файле /local/templates/furniture_pale-blue/header.php в тег &lt;div id="header"&gt; так: <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #00aeef; font-family: Courier New;"> &lt;div id="header" style="&lt;?$APPLICATION-&gt;ShowProperty("head_style")?&gt;"&gt; </span><br>
</div>
<div>
	<br>
</div>
<div>
	В result_modifier.php (в самый низ), добавляем: <br>
 <span style="color: #00aeef; font-family: Courier New;">if(!empty($arResult["DETAIL_PICTURE"]["SRC"])) </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	{ </span><br>
	<span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp; $arResult["STYLE"] = 'background-image: url('.$arResult["DETAIL_PICTURE"]["SRC"].'); background-size: contain;'; </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	}else{ </span><br>
	<span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp; $arResult["STYLE"] = ""; </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	} </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	$obComponent = $this-&gt;GetComponent(); </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	$obComponent-&gt;SetResultCacheKeys(array("STYLE")); </span><br>
</div>
<div>
	<br>
</div>
<div>
	В component_epilog.php: <br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();</span><br>
	<span style="color: #00aeef; font-family: Courier New;">if(isset($arResult["STYLE"]))</span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	{</span><br>
	<span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp; </span><span style="color: #00aeef; font-family: Courier New;">$APPLICATION-&gt;SetPageProperty("head_style", $arResult["STYLE"]);</span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	}</span>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>