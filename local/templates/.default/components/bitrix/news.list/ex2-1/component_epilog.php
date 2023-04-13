<?
if($arParams["POKAZ_COUNT"] == "Y")
{
	$APPLICATION->SetTitle("Новости, горящих -".$arResult["COUNT_DATE_NOW"]);
	$APPLICATION->SetTitle("Новости (важных: 2)");
}
?>