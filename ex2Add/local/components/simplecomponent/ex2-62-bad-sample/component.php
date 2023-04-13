<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
use Bitrix\Main\Loader, Bitrix\Iblock;

//dump($arParams);

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
	
	
	//Вытаскиваем альтернативный классификатор
	$arSelectСlassifier = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
	);
	
	$arFilterСlassifier = array (
		"IBLOCK_ID" => $arParams["IBLOCK_CLASSIFIER_ID"], 
		"ACTIVE" => "Y",
	);
		
	$arResult["CLASSIFIER"] = array();
	$rsElementСlassifier = CIBlockSection::GetList(false, $arFilterСlassifier, false, $arSelectСlassifier, false);
	while($arElement = $rsElementСlassifier->GetNext())
	{
		//$arElement["LINK_SECTIONS"] = array();
		//$arElement["LINK_ELEMENTS"] = array();
		$arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
	}
	$arResult["COUNT_CLASSIFIER"] = count($arResult["CLASSIFIER"]);
	

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
	);
	
	$arResult["SECTIONS"] = array();
	$rsElementSection = CIBlockSection::GetList(false, $arFilterSection, false, $arSelectSection, false);
	while($arElement = $rsElementSection->GetNext())
	{
		//строим связи классификатор - элементы, при такоми способе сохраним сортировку элементов
		/*if(count($arElement[$arParams["CLASSIFIER_PROP_CODE"]]) > 0)
		{
			foreach($arElement[$arParams["CLASSIFIER_PROP_CODE"]] as $elem)
			{
				$arResult["CLASSIFIER"][$elem]["LINK_SECTIONS"][] = $arElement["ID"];
			}
		}*/
		$arResult["SECTIONS"][$arElement["ID"]] = $arElement;
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
		"IBLOCK_SECTION_ID"
	);
	
	//dump($arFilter);
	$arSortElems = array (
		"NAME" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
		
	$rsElementElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElementElement->GetNext())
	{	
		//строим связи классификатор - элементы, при такоми способе сохраним сортировку элементов
		/*if($arElement["IBLOCK_SECTION_ID"] > 0)
		{
			foreach($arResult["SECTIONS"][$arElement["IBLOCK_SECTION_ID"]][$arParams["CLASSIFIER_PROP_CODE"]] as $elem)
			{
				$arResult["CLASSIFIER"][$elem]["LINK_ELEMENTS"][] = $arElement["ID"];
			}
		}*/
		
		//собираем данные 
		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
	}

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
$APPLICATION->SetTitle("Разделов  - ".$arResult["COUNT_CLASSIFIER"]);