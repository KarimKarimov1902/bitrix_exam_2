<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// Далее ex2-109
if(isset($arResult["STYLE"]))
{
	$APPLICATION->SetPageProperty("head_style", $arResult["STYLE"]);
}