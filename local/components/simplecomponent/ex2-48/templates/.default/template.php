<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

Фильтр: <a href="<?=$APPLICATION->GetCurPage();?>?F=Y"><?=$APPLICATION->GetCurPage();?>?F=Y</a>
 
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
			?><li><?=$elem["NAME"]?> - <?=$elem["PROPERTY_PRICE_VALUE"]?> - <?=$elem["PROPERTY_MATERIAL_VALUE"]?> - <?=$elem["PROPERTY_ARTNUMBER_VALUE"]?></li><?
		}
	}
	?>
	</ul>
<?
}
?>
</ul>
