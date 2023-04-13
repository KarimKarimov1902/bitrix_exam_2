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
$cFilter = 0;

if(isset($_REQUEST["Clear"]))
{
	LocalRedirect($APPLICATION->GetCurPage());
}
elseif(isset($_REQUEST["GO"]))
{	
	if(isset($_REQUEST["filtr1"]))
	{
		$cFilter++;
		$arParams["FILTER"][] = array(">=PROPERTY_PRICE" => "1500", "PROPERTY_MATERIAL" => "Дерево, ткань");
	}
	if(isset($_REQUEST["filtr2"]))
	{
		$cFilter++;
		$arParams["FILTER"][] = array("<PROPERTY_PRICE" => "1500", "PROPERTY_MATERIAL" => "Металл, пластик");
	}
	if($cFilter > 1)
	{
		$arParams["FILTER"]["LOGIC"] = "OR";
	}
}

	
if ($this->startResultCache(false, array($USER->GetGroups()))) 
{
	$this->AbortResultCache();
	
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
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
		"sort" => "asc",
	);
	
	$arResult["SECTIONS"] = array();
	$rsSecList = CIBlockSection::GetList($arSort_section, $arFilter_section, false, false, false);
	while($arSec = $rsSecList->GetNext())
	{
		$arResult["SECTIONS"][$arSec["ID"]] = $arSec;
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
		"PROPERTY_LINK_ELEMENT"
	);
	
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_LID" => SITE_ID,
		"ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
	
	if(count($arParams["FILTER"]) > 0)
	{
		$arFilterElems[] = $arParams["FILTER"];
		$this->AbortResultCache();
	}
	
	//dump($arFilter);
	
	$arSortElems = array (
			"SORT" => "ASC"
	);
	
	$arResult["ELEMENTS"] = array();
	$arResult["ELEMENTS_ID"] = array();
	$rsElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElement->GetNext())
	{
		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
		$arResult["ELEMENTS_ID"][] = $arElement["ID"];
	}
	
	//Вытаскиваем связи разделы-элементы, важно элементов не больше 500 
	$rsElemSect = CIBlockElement::GetElementGroups($arResult["ELEMENTS_ID"], true, array('ID', 'IBLOCK_ELEMENT_ID'));
	$arResult["ELEMENTS_SECTIONS"] = array(); 
	while ($arElem = $rsElemSect->Fetch())
	{
		$arResult["ELEMENTS_SECTIONS"][$arElem['ID']][] = $arElem['IBLOCK_ELEMENT_ID'];
	}	
	
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache();
}
