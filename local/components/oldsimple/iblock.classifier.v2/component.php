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
		"PROPERTY_COUNTRY",
		"PROPERTY_TYPE",
	);
	
	$arFilterСlassifier = array (
		"IBLOCK_ID" => 7,
		"IBLOCK_LID" => SITE_ID,
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
		
	$arResult["CLASSIFIER"] = array();
	$rsElement_link = CIBlockElement::GetList(false, $arFilterСlassifier, false, array("nPageSize" => 2), $arSelectСlassifier);
	while($arElement = $rsElement_link->GetNext())
	{
		$arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
	}
	$arResult["NAV_STRING"] = $rsElement_link->GetPageNavString("Странички");
	
	
	//Вытаскиваем элементы
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_TEXT",
		"PROPERTY_PRICE",
		"PROPERTY_MATERIAL",
		"PROPERTY_COMPANY"
	);
	
	//ToDo похоже стоит передавать значения классификатора
	
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_LID" => SITE_ID,
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
	
	
	//dump($arFilter);
	$arSortElems = array (
		"SORT" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
	$rsElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElement->GetNext())
	{
		//dump($arElement);
		$arElement["CLASSIFIER"] = $arElement["PROPERTY_COMPANY_VALUE"];
		/*if($arElement["CLASSIFIER"] == "")
		{
			$arElement["CLASSIFIER"] = "EMPTY";
		}*/
		$arResult["ELEMENTS"][] = $arElement;
	}
		
	
	
	//Вытаскиваем все значения для свойства товара
	$arSelectProperty = array (
			"ID",
			"IBLOCK_ID",
			"PROPERTY_MATERIAL",
	);
	
	$arFilterProperty = array (
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
	);
	
	$arResult["PROPERTY"] = array();
	$rsElementProperty = CIBlockElement::GetList(false, $arFilterProperty, array("PROPERTY_MATERIAL"), false, $arSelectProperty);
	while($arElement = $rsElementProperty->GetNext())
	{
		$arResult["PROPERTY"][] = $arElement;
	}
	//dump($arResult["PROPERTY"]);
	
	
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache();
}
