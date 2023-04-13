<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
//dump($_REQUEST);
//dump($arResult["NAV_STRING"]);
/*?>
---<p><b>В нашем каталоге представлены товары из материалов:</b></p>
<ul>
<?
foreach($arResult["PROPERTY"] as $prop)
{
	?><li><?=$prop["PROPERTY_MATERIAL_VALUE"]?> - <?=$prop["CNT"]?></li><?
}
?>
</ul>
---<p><b>Каталог:</b></p>
<ul>
<?*/
foreach($arResult["CLASSIFIER"] as $section)
{
	?>
	<li><b><?=$section["NAME"]?> - <?=$section["PROPERTY_COUNTRY_VALUE"]?> - <?=$section["PROPERTY_TYPE_VALUE"]?></b></li>
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
<br>---<p><b>Навигация:</b></p>
<?echo $arResult["NAV_STRING"]?>