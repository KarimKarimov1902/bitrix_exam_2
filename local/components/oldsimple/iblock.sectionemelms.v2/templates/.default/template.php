<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
//dump($_REQUEST);
//dump($arResult["NAV_STRING"]);
?>
<form name="filtr" method="get">
 <p><input type="checkbox" name="filtr1" value="OK">Показать товары с наличием услуги «Мебель на заказ» 
 <br><input type="checkbox" name="filtr2" value="OK">Показать товары с ценой меньше 9000 и материалов равным «Кожа, ткань»
 </p>
 <p>
 <bt><bt><input type="submit" value="Отобрать" name="GO">
 </p>
</form>
<br><br><br>

<ul>
<?
foreach($arResult["SECTIONS"] as $secion)
{
	?>
	<li><?=$secion["NAME"]?></li>
	<ul>
	<? 
	foreach($secion["ELEMENTS"] as $elem)
	{
		?><li><?=$elem["NAME"]?> - <?=$elem["PROPERTY_PRICE_VALUE"]?> - <?=$elem["PROPERTY_MATERIAL_VALUE"]?><?
		if(intval($elem["PROPERTY_LINK_ELEMENT_VALUE"] > 0))
		{
			?> - <?=$arResult["LINK_ELEMENTS"][$elem["PROPERTY_LINK_ELEMENT_VALUE"]]["NAME"]?> - <?=$arResult["LINK_ELEMENTS"][$elem["PROPERTY_LINK_ELEMENT_VALUE"]]["PROPERTY_PRICE_VALUE"]?><?
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