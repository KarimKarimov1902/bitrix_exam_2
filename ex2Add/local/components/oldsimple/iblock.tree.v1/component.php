<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
use Bitrix\Main\Context, Bitrix\Main\Type\DateTime, Bitrix\Main\Loader, Bitrix\Iblock;

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
	$arParams["FILTER"][] = array(">PROPERTY_PRICE" => 10000, "PROPERTY_MATERIAL" => "Кожа, металл, ткань");
}
if(isset($_REQUEST["filtr2"]))
{
	$this->AbortResultCache();
	$count_filter++;
	$arParams["FILTER"][] = array("<PROPERTY_PRICE" => 9000, "PROPERTY_MATERIAL" => "Кожа, ткань");
}
if($count_filter > 1)
{
	$arParams["FILTER"]["LOGIC"] = "OR";
}

if ($this->startResultCache(false, array($arParams["FILTER"]))) 
{
	
	if (!Loader::includeModule("iblock")) 
	{
		$this->abortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
		
	// Вытаскиваем разделы
	$arFilter = Array (
			'IBLOCK_ID' => $arParams["IBLOCK_ID"],
			'GLOBAL_ACTIVE' => 'Y',
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y" 
	);

	
	$arSort = array (
			"name" => "asc",
			"left_margin" => "asc",
	);
	
	$arResult["SECTIONS"] = array();
	$db_sec_list = CIBlockSection::GetList ( $arSort, $arFilter, true );
	while($ar_result = $db_sec_list->GetNext()) 
	{
		$arResult["SECTIONS"][$ar_result["ID"]] = $ar_result;
	}
	
	// Вытаскиваем элементы
	
	$arSelect = array (
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"PREVIEW_TEXT",
			"PROPERTY_PRICE",
			"PROPERTY_MATERIAL" 
	);
	
	$arFilter = array (
			"IBLOCK_ID" => $arParams ["IBLOCK_ID"],
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			"CHECK_PERMISSIONS" => "Y", 
	);
	
	if(count($arParams["FILTER"]))
	{
		$arFilter[] = $arParams["FILTER"];
		$this->AbortResultCache();
	}

	//dump($arFilter);
	
	$arSort = array (
			"SORT" => "ASC" 
	);
	
	$arResult["ELEMENTS"] = array();
	$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
	while($arElement = $rsElement->GetNext())
	{
		$arResult["SECTIONS"][$arElement["IBLOCK_SECTION_ID"]]["ELEMENTS"][] = $arElement;
		//$arResult["ELEMENTS"][] = $arElement;
	}
	
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache ();
}
