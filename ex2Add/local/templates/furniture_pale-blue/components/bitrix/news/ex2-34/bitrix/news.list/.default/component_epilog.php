<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
if($arParams["POKAZ_COUNT"] == "Y")
{
	$APPLICATION->SetPageProperty("specialcount", $arResult["ITEMS_DATE_NOW"]);
}
?>