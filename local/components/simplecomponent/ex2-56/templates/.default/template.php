<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

Фильтр: <a href="<?=$APPLICATION->GetCurPage();?>?F=Y"><?=$APPLICATION->GetCurPage();?>?F=Y</a>
 
<br>---<p><b>Каталог:</b></p>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
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
			?><li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?=$elem["NAME"]?> - <?=$elem["PROPERTY_PRICE_VALUE"]?> - <?=$elem["PROPERTY_MATERIAL_VALUE"]?></li><?
		}
	}
	?>
	</ul>
<?
}
?>
</ul>
