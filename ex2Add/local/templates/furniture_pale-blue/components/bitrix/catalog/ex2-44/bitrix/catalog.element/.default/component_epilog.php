<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams["SET_META_SPECIANCOUNT"] == "Y")
{
	$APPLICATION->SetPageProperty("specialcount", $arResult["STRLEN_TEXT"]);
}
?>