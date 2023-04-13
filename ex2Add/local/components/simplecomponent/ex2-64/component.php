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
	
	//Вытаскиваем новости
	$arSelectNews = array (
			"ID",
			"IBLOCK_ID",
			"NAME",
			"DATE_ACTIVE_FROM",
	);
	
	$arFilterNews = array (
			"IBLOCK_ID" => $arParams["IBLOCK_CLASSIFIER_ID"],
			"ACTIVE" => "Y",
	);
	
	//dump($arFilter);
	$arSortNews = array (
			"NAME" => "ASC"
	);
	
	$arResult["NEWS"] = array();
	
	$rsElementNews = CIBlockElement::GetList($arSortNews, $arFilterNews, false, false, $arSelectNews);
	while($arElement = $rsElementNews->GetNext())
	{
		//собираем данные
		$arResult["NEWS"][$arElement["ID"]] = $arElement;
	}
	
	

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
		"DEPTH_LEVEL" => 1,
	);
	
	$arResult["SECTIONS"] = array();
	$arResult["SECTIONS_IDS"] = array();
	$rsElementSection = CIBlockSection::GetList(false, $arFilterSection, false, $arSelectSection, false);
	while($arElement = $rsElementSection->GetNext())
	{
		//собираем ID шники для отбора новостей - может быть
		/*if(count($arElement[$arParams["CLASSIFIER_PROP_CODE"]]) > 0)
		{
			foreach($arElement[$arParams["CLASSIFIER_PROP_CODE"]] as $elem)
			{
				$arResult["CLASSIFIER"][$elem]["LINK_SECTIONS"][] = $arElement["ID"];
			}
		}*/
		$arResult["SECTIONS"][$arElement["ID"]] = $arElement;
		$arResult["SECTIONS_IDS"][] = $arElement["ID"];
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
		"SECTION_ID" => $arResult["SECTIONS_IDS"]
	);
	
	//dump($arFilter);
	$arSortElems = array (
		"NAME" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
	$arResult["ELEMENTS_ID"] = array();
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
		$arResult["ELEMENTS_ID"][] = $arElement["ID"];
	}
	$arResult["COUNT_CLASSIFIER"] = count($arResult["ELEMENTS"]);
	
	
	//Вытаскиваем связи разделы-элементы, важно элементов не больше 500
	$rsElemSect = CIBlockElement::GetElementGroups($arResult["ELEMENTS_ID"], true, array('ID', 'IBLOCK_ELEMENT_ID'));
	$arResult["ELEMENTS_SECTIONS"] = array();
	while ($arElem = $rsElemSect->Fetch())
	{
		$arResult["ELEMENTS_SECTIONS"][$arElem['ID']][] = $arElem['IBLOCK_ELEMENT_ID'];
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
$APPLICATION->SetTitle("Элементов  - ".$arResult["COUNT_CLASSIFIER"]);