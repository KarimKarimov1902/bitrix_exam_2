<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>"; print_r( $arResult["CLASSIFIER"] ); echo "</pre>";?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<ul>
<?
foreach($arResult["CLASSIFIER"] as $section){?>
	<? // ex2-58
	$this->AddEditAction($section["ID"], $arResult["ITEMS"]["EDIT_LINK"], CIBlock::GetArrayByID($arResult[$section["IBLOCK_ID"]], "ELEMENT_EDIT"));
	$this->AddDeleteAction($section["ID"], $arResult["ITEMS"]["EDIT_LINK"], CIBlock::GetArrayByID($arResult[$section["IBLOCK_ID"]], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("NEWS_DELETE_CONFIRM")));
	?>
	<li id="<?=$this->GetEditAreaId($section["ID"]);?>"><b><?=$section["NAME"]?></b></li><!-- End ex2-58 -->
	<ul>
	<? 
	if( is_array($section["ELEMENTS_ID"]) && (count($section["ELEMENTS_ID"]) > 0)){
		foreach($section["ELEMENTS_ID"] as $elem){?>

			<div>
				<li><?=$arResult["ELEMENTS"][$elem]["NAME"]?> - <?=$arResult["ELEMENTS"][$elem]["PROP"]["PRICE"]["VALUE"]?> - <?=$arResult["ELEMENTS"][$elem]["PROP"]["MATERIAL"]["VALUE"]?></li>
			</div>
		<?}
	}?>
	</ul>
<?}?>
</ul>