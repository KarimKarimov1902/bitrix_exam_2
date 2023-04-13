<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,	Bitrix\Iblock;

if (!isset($arParams["CACHE_TIME"]))
{
	$arParams["CACHE_TIME"] = 36000000;
}

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}
global $CACHE_MANAGER;//  [ex2-107]
if($this->startResultCache(false, false, '/servicesIblock')){//[ex2-107]

    if (!Loader::includeModule("iblock")) 
    {
        $this->abortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }

    $CACHE_MANAGER->RegisterTag('iblock_id_3');// [ex2-107]

    //Вытаскиваем классификатор
    $arSelectСlassifier = array (
        "ID",
        "IBLOCK_ID",
        "NAME",
    );
    
    $arFilterСlassifier = array (
        "IBLOCK_ID" => $arParams["FIRMS_IBLOCK_ID"],
        "CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
        "ACTIVE" => "Y",
    );
        
    $arResult["CLASSIFIER"] = array();
    $rsElement_link = CIBlockElement::GetList(
        false, 
        $arFilterСlassifier,
        false,
        false,
        $arSelectСlassifier
    );
    while($arElement = $rsElement_link->GetNext())
    {
        $arResult["CLASSIFIER_ID"][] = $arElement["ID"];
        $arResult["CLASSIFIER"][$arElement["ID"]] = $arElement;
    }
    $arResult["COUNT_CLASS"] = count($arResult["CLASSIFIER"]);
    
    $arSelectElems = array (
        "ID",
        "IBLOCK_ID",
        "IBLOCK_SECTION_ID",
        "NAME",
        "PREVIEW_TEXT",
    );
    
    $arFilterElems = array (
        "IBLOCK_ID" => $arParams["PRODUCT_IBLOCK_ID"],
        "CHECK_PERMISSIONS" => $arParams["CACHE_GROUPS"],
        "PROPERTY_".$arParams["PROPERTY_FIRMS"] => $arResult["CLASSIFIER_ID"],
        "ACTIVE" => "Y",
    );
    
    $arSortElems = array (
        "SORT" => "ASC"
    );

    $arResult["ELEMENTS"] = array();
        
    $rsElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
    while($rsElem = $rsElement->GetNextElement())
    {
        $arEl = $rsElem->GetFields();
        $arEl["PROP"] = $rsElem->GetProperties();
        
        foreach($arEl["PROP"]["COMPANY_MULTY"]["VALUE"] as $val)
        {
            $arResult["CLASSIFIER"][$val]["ELEMENTS_ID"][] = $arEl["ID"];
        }
        
        $arResult["ELEMENTS"][$arEl["ID"]] = $arEl;
    }

    //$this->SetResultCacheKeys(array("COUNT_CLASS"));
    $this->includeComponentTemplate();
    $this->endResultCache(); // [ex2-107]
}else 
{
	$this->abortResultCache();
}
//$APPLICATION->SetTitle(GetMessage("COUNT_FIRMS_PRODUCT").$arResult["COUNT_CLASS"]);