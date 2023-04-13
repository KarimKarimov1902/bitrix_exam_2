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

$arParams["FILTER"] = array();
$count_filter = 0;
if(isset($_REQUEST["filtr1"]))
{
	/*$this->AbortResultCache();
	$count_filter++;
	$arParams["FILTER"][] = array("PROPERTY_LINK_ELEMENT" => 28);*/
}
if(isset($_REQUEST["filtr2"]))
{
	$this->AbortResultCache();
	$count_filter++;
	$arParams["FILTER"][] = array("<PROPERTY_PRICE" => 12000, "PROPERTY_MATERIAL" => "Кожа, ткань");
}
if($count_filter > 1)
{
	$arParams["FILTER"]["LOGIC"] = "OR";
}

//dump($GLOBALS[$arParams["PAGER_PARAMS_NAME"]]);


	
if ($this->startResultCache(false, array($arParams["FILTER"]))) 
{
	$this->AbortResultCache();
	
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
	//Вытаскиваем классификатор
	$arSelect_classifier = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
		"PROPERTY_COUNTRY",
		"PROPERTY_TYPE",
	);
	
	$arFilter_classifier = array (
		"IBLOCK_ID" => 7,
		"IBLOCK_LID" => SITE_ID,
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
		
	$arResult["CLASSIFIER"] = array();
	$rsElement_link = CIBlockElement::GetList(false, $arFilter_classifier, false, Array("nPageSize"=>2), $arSelect_classifier);
	while($arElement = $rsElement_link->GetNext())
	{
		$arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
	}
	$arResult["NAV_STRING"] = $rsElement_link->GetPageNavString("Странички");
	
	//dump($arResult["CLASSIFIER"]);
	//для пустого значения классификата
	//$arResult["CLASSIFIER"]["EMPTY"] = array("ID" => "EMPTY", "NAME" => "НЕТ ЗНАЧЕНИЯ");
	
	//Вытаскиваем элементы
	$arSelect_elems = array (
		"ID",
		"IBLOCK_ID",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_TEXT",
		"PROPERTY_PRICE",
		"PROPERTY_MATERIAL",
		"PROPERTY_LINK_ELEMENT",
		"PROPERTY_COMPANY"
	);
	
	//ToDo похоже стоит передавать значения классификатора
	
	$arFilter_elems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_LID" => SITE_ID,
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
	
	if(count($arParams["FILTER"]) > 0)
	{
		$arFilter_elems[] = $arParams["FILTER"];
		$this->AbortResultCache();
	}
	
	//dump($arFilter);
	$arSort_elems = array (
		"SORT" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
	$rsElement = CIBlockElement::GetList($arSort_elems, $arFilter_elems, false, false, $arSelect_elems);
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
	$arSelect_property = array (
		"ID",
		"IBLOCK_ID",
		"PROPERTY_MATERIAL",
	);
	
	$arFilter_property = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_LID" => SITE_ID,
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
	
	$arResult["PROPERTY"] = array();
	$rsElement_property = CIBlockElement::GetList(false, $arFilter_property, array("PROPERTY_MATERIAL"), false, $arSelect_property);
	while($arElement = $rsElement_property->GetNext())
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
