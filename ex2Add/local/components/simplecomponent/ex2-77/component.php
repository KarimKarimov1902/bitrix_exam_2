<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}
//==========================================================================

if($this->startResultCache(false, false)){
	        if (!Loader::includeModule("iblock")) 
        {
            $this->abortResultCache();
            ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
            return;
        }
	
	//Вытаскиваем альтернативный классификатор
	$arSelectСlassifier = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
	);
	
	$arFilterСlassifier = array (
		"IBLOCK_ID" => $arParams["ALTER_IBLOCK_ID"], 
		"ACTIVE" => "Y",
	);
		
	$arResult["CLASSIFIER"] = array();
	$rsElementСlassifier = CIBlockSection::GetList(false, $arFilterСlassifier, false, $arSelectСlassifier, false);
	while($arElement = $rsElementСlassifier->GetNext())
	{
		$arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
	}
	$arResult["COUNT_CLASSIFIER"] = count($arResult["CLASSIFIER"]);
	

	//Вытаскиваем разделы
	$arSelectSection = array(
		"ID",
		"IBLOCK_ID",
		"NAME",
		$arParams["CODE_ALTER"]
	);
	
	$arFilterSection = array (
		"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
		"ACTIVE" => "Y",
	);
	
	$arResult["SECTIONS"] = array();
	$rsElementSection = CIBlockSection::GetList(false, $arFilterSection, false, $arSelectSection, false);
	while($arElement = $rsElementSection->GetNext())
	{
		//строим связи классификатор - элементы, при такоми способе сохраним сортировку элементов
		if($arElement[$arParams["CODE_ALTER"]] > 0)
		{
			$arResult["CLASSIFIER"][$arElement[$arParams["CODE_ALTER"]]]["LINK_SECTIONS"][] = $arElement["ID"];
		}
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
		"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
		"ACTIVE" => "Y"
	);
	
	$arSortElems = array (
		"NAME" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
		
	$rsElementElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElementElement->GetNext())
	{	
		//строим связи классификатор - элементы, при такоми способе сохраним сортировку элементов
		if($arResult["CLASSIFIER"][$arResult["SECTIONS"][$arElement["IBLOCK_SECTION_ID"]][$arParams["CODE_ALTER"]]] > 0)
		{
			$arResult["CLASSIFIER"][$arResult["SECTIONS"][$arElement["IBLOCK_SECTION_ID"]][$arParams["CODE_ALTER"]]]["LINK_ELEMENTS"][] = $arElement["ID"];
		}
		
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

$APPLICATION->SetTitle(GetMessage("RAZDELS").$arResult["COUNT_CLASSIFIER"]);
?>