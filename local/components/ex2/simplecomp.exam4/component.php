<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if(intval($arParams["PRODUCTS_IBLOCK_ID"]) > 0)
{

	if(!$productIblockId = $arParams['PRODUCTS_IBLOCK_ID']) return false;
	if(!$newsIblockId = $arParams['NEWS_IBLOCK_ID']) return false;
	if(!$propCode = $arParams['PROPERTY_CODE']) return false;


	
	
	$arAllSections = array();
	$arIdNews = array();
	$rsSections = CIBlockSection::GetList(false, 
		array (
			"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
			"ACTIVE" => "Y",
			"!".$propCode =>false,
		), 
		true, 
		array (
			"ID",
			"NAME",
			$propCode
		), 
		false
	);
	while($arSection = $rsSections->GetNext())
	{
		if($arSection['ELEMENT_CNT'] > 0){
			$arAllSections[$arSection['ID']] = array(
				"NAME" => $arSection['NAME'],
				"NEWS" => $arSection[$propCode],
			);

			foreach($arSection[$propCode] as $newId){
				if(!in_array($newId, $arIdNews)) $arIdNews[] = $newId;
			}
		}

	}
	
	// Новости
	$arAllNews = array();
	$rsNews = CIBlockElement::GetList(
		false, 
		array (
			"IBLOCK_ID" => $arParams['NEWS_IBLOCK_ID'],
			"ACTIVE" => "Y",
			"ID" => $arIdNews,
		),
		false, false, 
		array (
			"ID",
			"NAME",
			"ACTIVE_FROM"
		)
	);
	while($arElement = $rsNews->GetNext())
	{
		$arAllNews[$arElement['ID']] = array(
			"NAME" => $arElement['NAME'],
			"ACTIVE_FROM" =>$arElement['ACTIVE_FROM'],
			'SECTIONS' => array(),
			'PRODUCTS' => array(),
		);
	}


	// Продукция
	$arAllProducts = array();
	$rsProducts = CIBlockElement::GetList(false, 
		array (
			"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
			"ACTIVE" => "Y",
			"SECTION_ID" => array_keys($arAllSections),
		),
		false, false, 
		array (
			"ID",
			"NAME",
			"IBLOCK_SECTION_ID",
			"PROPERTY_MATERIAL" , "PROPERTY_ARTNUMBER", "PROPERTY_PRICE",
		)
	);
	while($arProduct = $rsProducts->GetNext())
	{
		$prodId = $arProduct['ID'];
		$arAllProducts[$prodId] = array(
			"NAME" => $arProduct['NAME'],
			"MATERIAL" => $arProduct['PROPERTY_MATERIAL_VALUE'],
			"ARTNUMBER" => $arProduct['PROPERTY_ARTNUMBER_VALUE'],
			"PRICE" => $arProduct['PROPERTY_PRICE_VALUE'],
		);

		$IBLOCK_SECTION_ID  = $arProduct['IBLOCK_SECTION_ID'];
		foreach($arAllSections[$IBLOCK_SECTION_ID]['NEWS'] as $newsId){
			$arAllNews[$newsId]['PRODUCTS'][] = $prodId;

			if(!in_array($IBLOCK_SECTION_ID, $arAllNews[$newsId]['SECTIONS'])){
				$arAllNews[$newsId]['SECTIONS'][] = $IBLOCK_SECTION_ID;
			}
		}
	}

	$arResult["ITEMS"] = $arAllNews;
	$arResult['SECTIONS'] = $arAllSections; 
	$arResult["PRODUCTS"] = $arAllProducts;
	$arResult["COUNT_PRODUCTS"] = count($arAllProducts);

	$this->SetResultCacheKeys(array(
		"ITEMS",
		"SECTIONS",
		"PRODUCTS",
		"COUNT_PRODUCTS",
	 ));
}


$this->includeComponentTemplate();	

$APPLICATION->SetTitle(GetMessage('SET_TITLE').$arResult['COUNT_PRODUCTS']);

?>