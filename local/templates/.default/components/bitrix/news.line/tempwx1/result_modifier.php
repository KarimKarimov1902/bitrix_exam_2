<?
dump($arResult);

$arResult["COUNT"] = count($arResult["ITEMS"]);
$arResult["DATE"] = $arResult["ITEMS"][0]["DATE_ACTIVE_FROM"];
$arResult["SORT"] = $arResult["ITEMS"][0]["SORT"];

$cp = $this->GetComponent();
$cp->SetResultCacheKeys(array(
	"COUNT",
	"DATE",
	"SORT"
));


?>