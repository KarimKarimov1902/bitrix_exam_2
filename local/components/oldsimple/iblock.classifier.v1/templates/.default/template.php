<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
//dump($_REQUEST);
//dump($arResult["NAV_STRING"]);
?>
<br>---<p><b>Поиск:</b></p>
<form name="filtr" method="get">
 <p><input type="checkbox" name="filtr1" value="OK">Показать товары с наличием услуги «Мебель на заказ» 
 <br><input type="checkbox" name="filtr2" value="OK">Показать товары с ценой меньше 9000 и материалов равным «Кожа, ткань»
 </p>
 <p>
 <bt><bt><input type="submit" value="Отобрать" name="GO">
 </p>
</form>
<br>---<p><b>В нашем каталоге представлены товары из материалов:</b></p>
<ul>
<?
foreach($arResult["PROPERTY"] as $prop)
{
	?><li><?=$prop["PROPERTY_MATERIAL_VALUE"]?> - <?=$prop["CNT"]?></li><?
}
?>
</ul>
<br>---<p><b>Каталог:</b></p>
<ul>
<?
foreach($arResult["CLASSIFIER"] as $section)
{
	?>
	<li><?=$section["NAME"]?> - <?=$section["PROPERTY_PRICE_VALUE"]?></li>
	<ul>
	<? 
	foreach($arResult["ELEMENTS"] as $elem)
	{
		if($elem["CLASSIFIER"] == $section["ID"])
		{
			?><li><?=$elem["NAME"]?> - <?=$elem["PROPERTY_PRICE_VALUE"]?> - <?=$elem["PROPERTY_MATERIAL_VALUE"]?><?
		}
	}
	?>
	</li>
	</ul>
<?
}
?>
</ul>
<?echo $arResult["NAV_STRING"]?>