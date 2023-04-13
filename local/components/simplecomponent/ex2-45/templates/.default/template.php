<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
?>
---<p><b>Каталог:</b></p>
<ul>
<?
foreach($arResult["CLASSIFIER"] as $section)
{
	?>
	<li><b><?=$section["NAME"]?> - <?=$section["PROPERTY_COUNTRY_VALUE"]?></b></li>
	<ul>
	<? 
	if( is_array($section["ELEMENTS_ID"]) && (count($section["ELEMENTS_ID"]) > 0) )
	{
		foreach($section["ELEMENTS_ID"] as $elem)
		{
			?><li><?=$arResult["ELEMENTS"][$elem]["NAME"]?> - <?=$arResult["ELEMENTS"][$elem]["PROP"]["PRICE"]["VALUE"]?> - <?=$arResult["ELEMENTS"][$elem]["PROP"]["MATERIAL"]["VALUE"]?> - <?=$arResult["ELEMENTS"][$elem]["PROP"]["ARTNUMBER"]["VALUE"]?><?
		}
	}
	?>
	</li>
	</ul>
<?
}
?>
</ul>
