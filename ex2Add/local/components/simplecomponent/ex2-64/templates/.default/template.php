<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//ump($arResult);
?>
---<p><b>Каталог:</b></p>
<ul>
<?
foreach($arResult["ELEMENTS_SECTIONS"] as $IdSection => $arElemIDs)
{
	?>
	<li><b><?=$arResult["SECTIONS"][$IdSection]["NAME"]?></b> 
	<?
	$arNews = array();
	foreach($arResult["SECTIONS"][$IdSection][$arParams["CLASSIFIER_PROP_CODE"]] as $idNews)
		$arNews[] = " - ".$arResult["NEWS"][$idNews]["DATE_ACTIVE_FROM"]." - ".$arResult["NEWS"][$idNews]["NAME"];
	?>
	<br>Новости:<br><?=implode(",<br>", $arNews)?>
	</li>
	<ul>
	<?foreach($arElemIDs as $idElement):?>
		<li><?=$arResult["ELEMENTS"][$idElement]["NAME"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_PRICE_VALUE"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_MATERIAL_VALUE"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_ARTNUMBER_VALUE"]?> 
	<?endforeach;?>
	</li>
	</ul>
<?
}
?>
</ul>
