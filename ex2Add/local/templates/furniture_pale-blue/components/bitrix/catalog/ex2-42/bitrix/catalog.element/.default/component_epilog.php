<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
//$APPLICATION->SetTitle($arResult["COUNT_VACANS"]);
if($arResult["SET_CLASS"] == "Y")
{
	$APPLICATION->SetPageProperty("dop_class_style", "funny_color");
}
?>