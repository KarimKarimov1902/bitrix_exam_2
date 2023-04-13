<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
use Bitrix\Main\Loader;

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

$arParams["PROP_ARTICLE"] = (trim($arParams["PROP_ARTICLE"]));
$arResult["PROP_ARTICLE_CODE"] = "PROPERTY_".$arParams["PROP_ARTICLE"];
$arResult["COUNT_ELEM"] = 0;
$arResult["COUNT_SECTION"] = 0;

if(strlen($arParams["PROP_ARTICLE"]) == 0)
{
	ShowError ("не указано свойство PROP_ARTICLE");
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
		$arParams["FILTER"][] = array(">=PROPERTY_PRICE" => "1500", $arResult["PROP_ARTICLE_CODE"] => "%234%");
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


$this->SetResultCacheKeys(array(
	"IBLOCK_ID",
	"COUNT_ELEM",
	"COUNT_SECTION"
));

if ($this->startResultCache(false, array($USER->GetGroups()))) 
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
			"left_margin" => "asc",
			"sort" => "asc",
	);
	
	$arResult["SECTIONS"] = array();
	$rsSecList = CIBlockSection::GetList($arSort, $arFilter, true);
	while($arSec = $rsSecList->GetNext()) 
	{
		$arResult["SECTIONS"][$arSec["ID"]] = $arSec;
		$arResult["COUNT_SECTION"]++;
	}
	
	// Вытаскиваем элементы
	
	$arSelect = array (
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"PREVIEW_TEXT",
			"PROPERTY_PRICE",
			"PROPERTY_MATERIAL",
			$arResult["PROP_ARTICLE_CODE"]
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
		echo 111;
		$arFilter[] = $arParams["FILTER"];
		$this->abortResultCache();
	}

	//dump($arFilter);
	
	$arSort = array (
			"SORT" => "ASC" 
	);
	
	$arResult["ELEMENTS"] = array();
	$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
	while($arElement = $rsElement->GetNext())
	{
		$arResult["COUNT_ELEM"]++;
		/*$arButtons = CIBlock::GetPanelButtons(
			$arElement["IBLOCK_ID"],
			$arElement["ID"]
		);*/
		$arElement["BUTTON"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
		$arResult["SECTIONS"][$arElement["IBLOCK_SECTION_ID"]]["ELEMENTS"][] = $arElement;
		//$arResult["ELEMENTS"][] = $arElement;
	}

	$this->includeComponentTemplate();

} 

else 
{
	$this->abortResultCache();
}

$APPLICATION->SetTitle("Разделов ".$arResult["COUNT_SECTION"].", элементов ".$arResult["COUNT_ELEM"]);
