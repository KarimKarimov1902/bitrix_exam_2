<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
---<p><b>Поиск:</b></p>
<form name="filtr" method="get">
 <p><input type="checkbox" name="filtr1" value="OK">Показать товары с ценой больше или равной 1500 и материалом равным «Дерево, ткань»
 <br><input type="checkbox" name="filtr2" value="OK">Показать товары с ценой меньше 1500 и материалом равным «Металл, пластик»
 </p>
 <p>
 <bt><bt><input type="submit" value="Отобрать" name="GO"><input style="margin-left: 10px;" type="submit" value="Сброс" name="Clear">
 </p>
</form>
<br>---<p><b>Каталог:</b></p>
<?
foreach($arResult["SECTIONS"] as $secion)
{
	?>
	<li><?=$secion["NAME"]?></li>
	<ul>
	<? 
	if(isset($arResult["ELEMENTS_SECTIONS"][$secion["ID"]]))
	{
		
		foreach($arResult["ELEMENTS_SECTIONS"][$secion["ID"]] as $pos)
		{
			$elem = $arResult["ELEMENTS"][$pos];
			?><li><?=$elem["NAME"]?> - <?=$elem["PROPERTY_PRICE_VALUE"]?> - <?=$elem["PROPERTY_MATERIAL_VALUE"]?></li><?
		}
	}
	?>
	</ul>
<?
}
?>
</ul>
