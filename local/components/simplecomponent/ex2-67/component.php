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
	ShowError ("не указан иблок");
	return;
}

$arNavigation = CDBResult::GetNavParams($arNavParams);
//dump($arNavigation);


if ($this->startResultCache(false, array($arNavigation))) 
{
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
	//Вытаскиваем классификатор
	$arSelectСlassifier = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
		//"PROPERTY_COUNTRY"
	);
	
	$arFilterСlassifier = array (
		"IBLOCK_ID" => 8, //ToDo в параметр
		"ACTIVE" => "Y",
	);
		
	$arResult["CLASSIFIER"] = array();
	$arResult["CLASSIFIER_IDs"] = array();
	$rsElement_link = CIBlockSection::GetList(false, $arFilterСlassifier, false, $arSelectСlassifier);
	
	
	/*CIBlockElement::GetList(
		false, 
		$arFilterСlassifier,
		false,
		false,
		$arSelectСlassifier
	);*/
	
	while($arElement = $rsElement_link->GetNext())
	{
		$arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
		$arResult["CLASSIFIER_IDs"][] = $arElement["ID"];
	}
	$arResult["COUNT_CLASS"] = count($arResult["CLASSIFIER"]);
	
	//dump($arResult);
	
	//Вытаскиваем элементы
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_TEXT",
		/*"PROPERTY_PRICE",
		"PROPERTY_MATERIAL",
		"PROPERTY_COMPANY_MULTY"*/
		/*"PROPERTY_PRICE",
		"PROPERTY_ALT_CLASS"*/
	);
	
	//ToDo  передавать значения классификатора
	
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"PROPERTY_ALT_CLASS" => $arResult["CLASSIFIER_IDs"]
		//"PROPERTY_COMPANY_MULTY" => $arResult["CLASSIFIER_ID"]
	);
	
	//dump($arFilter);
	$arSortElems = array (
		"SORT" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
		
	$rsElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($rsElem = $rsElement->GetNextElement())
	//while($arElement = $rsElement->GetNext())
	{
		$arEl = $rsElem->GetFields();
		$arEl["PROP"] = $rsElem->GetProperties();
		//$arEl["PROP"] = $rsElem->GetProperty("ALT_CLASS");
		// $arEl["PROP"] = $rsElem->GetProperty("MATERIAL");
		 
		/*$arEl["PROP"] = $rsElem->GetProperties(
			false, 
			array(
				"CODE" => array("ALT_CLASS", "MATERIAL")
			)
		);*/
		
		//dump($arEl["PROP"]["COMPANY_MULTY"]["VALUE"]);
		foreach($arEl["PROP"]["ALT_CLASS"]["VALUE"] as $val)
		{
			$arResult["CLASSIFIER"][$val]["ELEMENTS_ID"][] = $arEl["ID"];
		}
		$arResult["ELEMENTS"][$arEl["ID"]] = $arEl;
	}
	$arResult["COUNT_ELEM"] = count($arResult["ELEMENTS"]);
	
	///dump(count($arResult["ELEMENTS"]));
	//dump($arResult["CLASSIFIER"]);
	//dump($arResult["ELEMENTS"]);
	
	
	$this->SetResultCacheKeys(array(
			"COUNT_CLASS",
			"COUNT_ELEM",
	));
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache();
}
//$APPLICATION->SetTitle("Разделов  - ".$arResult["COUNT_CLASS"]);
$APPLICATION->SetTitle("Элементов - ".$arResult["COUNT_ELEM"]);