<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
//use Bitrix\Main\Context, Bitrix\Main\Type\DateTime, Bitrix\Main\Loader, Bitrix\Iblock;
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
	$this->AbortResultCache();
	$count_filter++;
	$arParams["FILTER"][] = array("PROPERTY_LINK_ELEMENT" => 28);
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


if ($this->startResultCache(false, array($arParams["FILTER"]))) 
{
	$this->AbortResultCache();
	
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
	
	
	// Вытаскиваем элементы связанного ИБ
	$arSelect_link = array (
			"ID",
			"IBLOCK_ID",
			"NAME",
			"PROPERTY_PRICE",
	);
	
	$arFilter_link = array (
			"IBLOCK_ID" => 3,
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
	);
		
	$arResult["LINK_ELEMENTS"] = array();
	$rsElement_link = CIBlockElement::GetList(false, $arFilter_link, false, false, $arSelect_link);
	while($arElement = $rsElement_link->GetNext())
	{
		$arResult["LINK_ELEMENTS"][$arElement["ID"]] = $arElement;
		//$arResult["ELEMENTS"][] = $arElement;
	}
			
	
	
	//Вытаскиваем разделы
	$arFilter_section = Array (
			'IBLOCK_ID' => $arParams["IBLOCK_ID"],
			'GLOBAL_ACTIVE' => 'Y',
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y", 
			"DEPTH_LEVEL" => 1
	);

	
	$arSort_section = array (
			"name" => "asc",
	);
	
	$arResult["SECTIONS"] = array();
	$db_sec_list = CIBlockSection::GetList($arSort_section, $arFilter_section, false, false, array("nPageSize" => 2));
	$arResult["NAV_STRING"] = $db_sec_list->GetPageNavString("Странички");
		
	
	//готовим сразу все для элементов
	$arSelect_elems = array (
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"PREVIEW_TEXT",
			"PROPERTY_PRICE",
			"PROPERTY_MATERIAL",
			"PROPERTY_LINK_ELEMENT"
	);
	
	$arFilter_elems = array (
			"IBLOCK_ID" => $arParams ["IBLOCK_ID"],
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
	);
	
	if(count($arParams["FILTER"]))
	{
		$arFilter_elems[] = $arParams["FILTER"];
		$this->AbortResultCache();
	}
	
	//dump($arFilter);
	
	$arSort_elems = array (
			"SORT" => "ASC"
	);
	
	
	while($ar_result = $db_sec_list->GetNext()) 
	{
		$arResult["SECTIONS"][$ar_result["ID"]] = $ar_result;
		$arFilter_elems["SECTION_ID"] = $ar_result["ID"];
		$rsElement = CIBlockElement::GetList($arSort_elems, $arFilter_elems, false, false, $arSelect_elems);
		while($arElement = $rsElement->GetNext())
		{
			$arResult["SECTIONS"][$ar_result["ID"]]["ELEMENTS"][$arElement["ID"]] = $arElement;
			//$arResult["ELEMENTS"][$ar_result["ID"]] = $arElement;
			//$arResult["ELEMENTS"][] = $arElement;
		}
	}
		
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache ();
}
