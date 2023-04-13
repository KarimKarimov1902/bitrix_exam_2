<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
use Bitrix\Main\Loader, Bitrix\Iblock;

if (!isset($arParams["CACHE_TIME"]))
{
	$arParams["CACHE_TIME"] = 36000000;
}

$arParams["IBLOCK_ID"] = intval(trim($arParams["IBLOCK_ID"]));
if(!($arParams["IBLOCK_ID"] > 0))
{
	ShowError (GetMessage("T_IBLOCK_DESC_LIST_ID_NON"));
	return;
}

$arParams["IBLOCK_CLASSIFIER_ID"] = intval(trim($arParams["IBLOCK_CLASSIFIER_ID"]));
if(!($arParams["IBLOCK_CLASSIFIER_ID"] > 0))
{
	ShowError (GetMessage("T_IBLOCK_DESC_LIST_CLASSIFIER_ID_NON"));
	return;
}

$arParams["CLASSIFIER_PROP_CODE"] = trim($arParams["CLASSIFIER_PROP_CODE"]);
if( strlen($arParams["CLASSIFIER_PROP_CODE"]) < 1)
{
	ShowError (GetMessage("T_IBLOCK_DESC_CLASSIFIER_PROP_CODE_NON"));
	return;
}

if ($this->startResultCache(false, false)) 
{
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	//Вытаскиваем разделы
	$arSelectSection = array(
		"ID",
		"IBLOCK_ID",
		"NAME",
		$arParams["CLASSIFIER_PROP_CODE"]
	);
	
	$arFilterSection = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"DEPTH_LEVEL" => array (1),
	);
	
	$arResult["SECTIONS"] = array();
	$arResult["SECTIONS_IDS"] = array();
	$rsElementSection = CIBlockSection::GetList(false, $arFilterSection, false, $arSelectSection, false);
	while($arElement = $rsElementSection->GetNext())
	{
		$arResult["SECTIONS"][$arElement["ID"]] = $arElement;
		$arResult["SECTIONS_IDS"][] = $arElement["ID"];
		$arResult["SECTIONS_NAME"][$arElement["ID"]] = $arElement["NAME"];
	}
	//Вытаскиваем элементы
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_TEXT",
		"PROPERTY_PRICE",
		"PROPERTY_MATERIAL",
		"PROPERTY_ARTNUMBER"
	);
	
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"SECTION_ID" => $arResult["SECTIONS_IDS"]
	);

	$arSortElems = array (
		"NAME" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
	$arResult["ELEMENTS_ID"] = array();
	$rsElementElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElementElement->GetNext())
	{	
		//собираем данные 
		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
		$arResult["ELEMENTS_ID"][] = $arElement["ID"];
		if($arElement["PROPERTY_MATERIAL_VALUE"] == "Кожа, ткань"){
			$arResult["ITEM"]["Y"][$arResult["SECTIONS_NAME"][$arElement["IBLOCK_SECTION_ID"]]][] = $arElement["ID"];
		}else{
			$arResult["ITEM"]["N"][$arResult["SECTIONS_NAME"][$arElement["IBLOCK_SECTION_ID"]]][] = $arElement["ID"];
		}
	}

	$arResult["COUNT_CLASSIFIER"] = count($arResult["ELEMENTS"]);

	//dump($arResult);
	$this->SetResultCacheKeys(array(
		"COUNT_CLASSIFIER",
	));
	
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache();
}
$APPLICATION->SetTitle("Элементов  - ".$arResult["COUNT_CLASSIFIER"]);