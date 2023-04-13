<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?


$stNameTovar = "<b>Товары этого раздела</b>:<ul>";
$inMinPriceTovar = 1000000;
$inMinPriceTovarName = "";
foreach ($arResult['ITEMS'] as $key => $arItem)
{
	if($arItem['PRICES']['PRICE']['VALUE'] < $inMinPriceTovar)
	{
		$inMinPriceTovar = $arItem['PRICES']['PRICE']['VALUE'];
		$inMinPriceTovarName = $arItem["NAME"];
	}
	$arPrice[$arItem["ID"]] = $arItem['PRICES']['PRICE']['VALUE'];
	$arItem['PRICES']['PRICE']['PRINT_VALUE'] = number_format($arItem['PRICES']['PRICE']['PRINT_VALUE'], 0, '.', ' ');
	$arItem['PRICES']['PRICE']['PRINT_VALUE'] .= ' '.$arItem['PROPERTIES']['PRICECURRENCY']['VALUE_ENUM'];
	$arResult['ITEMS'][$key] = $arItem;
	$arResult["NEW_PRICES"][] = $arItem["PROPERTIES"]["PRICE"]["VALUE"];
	$stNameTovar .= "<li>".$arItem["NAME"]."</li>";
}
$stNameTovar .= "</ul>";
//$this->SetViewTarget('list-elem-name');
//echo $stNameTovar;
//$this->EndViewTarget();
$this->SetViewTarget('list-elem-name');
echo "<center><br><b>Самый не дорогой товар раздела:<br>".$inMinPriceTovarName." - ".$inMinPriceTovar."</b><br><br><br></center>";
$this->EndViewTarget();

$cp = $this->__component;
$cp->SetResultCacheKeys(array(
   "NEW_PRICES"
));




?>