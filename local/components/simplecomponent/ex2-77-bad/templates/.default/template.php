<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b>Каталог:</b></p>
<ul>
<li><?="- ("?><?
foreach($arResult["ITEM"]["Y"] as $a => $b){?>
	<?=$a?>
<?}?><?=")"?></li>
<?
foreach($arResult["ITEM"]["Y"] as $IdSection => $arElemIDs){?>
	<ul>
	<?foreach($arElemIDs as $idElement):?>
		<li><?=$arResult["ELEMENTS"][$idElement]["NAME"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_PRICE_VALUE"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_MATERIAL_VALUE"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_ARTNUMBER_VALUE"]?> 
	<?endforeach;?>
	</li>
	</ul>
<?}?>
<li><?="- ("?><?
foreach($arResult["ITEM"]["N"] as $a => $b){?>
	<?=$a?>
<?}?><?=")"?></li>
<?
foreach($arResult["ITEM"]["N"] as $IdSection => $arElemIDs){?>
	<ul>
	<?foreach($arElemIDs as $idElement):?>
		<li><?=$arResult["ELEMENTS"][$idElement]["NAME"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_PRICE_VALUE"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_MATERIAL_VALUE"]?> - <?=$arResult["ELEMENTS"][$idElement]["PROPERTY_ARTNUMBER_VALUE"]?> 
	<?endforeach;?>
	</li>
	</ul>
<?}?>
</ul>
