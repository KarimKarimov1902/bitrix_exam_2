<?if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
use Bitrix\Main\Loader, Bitrix\Iblock;
if (!isset($arParams["CACHE_TIME"]))
{
	$arParams["CACHE_TIME"] = 36000000;
}
$arParams["IBLOCK_ID"] = intval(trim($arParams["IBLOCK_ID"]));
if(!($arParams["IBLOCK_ID"] > 0))
{
	ShowError ("не указан ИБлок");
	return;
}
$arNavigation = CDBResult::GetNavParams($arNavParams);
if ($this->startResultCache(false, array($arNavigation))) 
{
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	$arSelectСlassifier = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
	);
	$arFilterСlassifier = array (
		"IBLOCK_ID" => 3, //ToDo в параметр
		"ACTIVE" => "Y",
	);
	$arResult["CLASSIFIER"] = array();
	$arResult["CLASSIFIER_IDs"] = array();
	$rsElement_link = CIBlockSection::GetList(false, $arFilterСlassifier, false, $arSelectСlassifier);
	while($arElement = $rsElement_link->GetNext())
	{
		$arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
		$arResult["CLASSIFIER_IDs"][] = $arElement["ID"];
	}
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_TEXT",
	);
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"PROPERTY_ALTERCLASS" => $arResult["CLASSIFIER_IDs"]
	);
	$arSortElems = array (
		"SORT" => "ASC"
	);
	$arResult["ELEMENTS"] = array();
	$rsElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($rsElem = $rsElement->GetNextElement())
	{
		$arEl = $rsElem->GetFields();
		$arEl["PROP"] = $rsElem->GetProperties();
		foreach($arEl["PROP"]["ALTERCLASS"]["VALUE"] as $val)
		{
			$arResult["CLASSIFIER"][$val]["ELEMENTS_ID"][] = $arEl["ID"];
		}
		$arResult["ELEMENTS"][$arEl["ID"]] = $arEl;
	}
	$arResult["COUNT_ELEM"] = count($arResult["ELEMENTS"]);
	$this->SetResultCacheKeys(array(
			"COUNT_ELEM",
	));
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache();
}
$APPLICATION->SetTitle("Элементов - ".$arResult["COUNT_ELEM"]);
