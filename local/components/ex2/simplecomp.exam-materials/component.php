<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if ($this->StartResultCache())
{
	
	if(!$iblockProd = $arParams['PRODUCTS_IBLOCK_ID']) return false;
	if(!$iblockNews = (int)$arParams['NEWS_IBLOCK_ID']) return false;
	if(!$propCode = trim($arParams['PROPERTY_CODE'])) return false;

	$arAllSection = array();
	$arIdNews = array();
	$resSection = CIBlockSection::GetList(
		false,
		array('IBLOCK_ID'=>$iblockProd, 'ACTIVE' => 'Y', '!'.$propCode => false),
		true,
		array('ID', 'NAME', $propCode), //select
	);

	while($arSection = $resSection->GetNext()){
	
		if($arSection['ELEMENT_CNT'] > 0){
		
			$arAllSection[$arSection['ID']] = array(
				'NAME' => $arSection['NAME'],
				'NEWS' => $arSection[$propCode],
			);
			
			foreach($arSection[$propCode] as $newsId){
				if(!in_array($newsId, $arIdNews)) $arIdNews[] = $newsId;
			}
			
		} 
		
	}

	$arAllNews = array();
	$resNews = CIBlockElement::GetList(
		false, 
		array('IBLOCK_ID'=>$iblockNews, 'ACTIVE' => 'Y', 'ID' => $arIdNews),
		false, 
		false, 
		array('ID', 'NAME', 'ACTIVE_FROM'), //select
	);

	while($arNew = $resNews->GetNext()){
		$arAllNews[$arNew['ID']] = array(
			'NAME' => $arNew['NAME'],
			'ACTIVE_FROM' => $arNew['ACTIVE_FROM'],
			'SECTIONS' => array(),
			'PRODUCTS' => array(),
		);
	}

	$arAllProducts = array();
	$resProducts = CIBlockElement::GetList(
		false, 
		array('IBLOCK_ID'=>$iblockProd, 'ACTIVE' => 'Y', 'SECTION_ID' => array_keys($arAllSection)),
		false, 
		false, 
		array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER'), //select
	);

	while($arProduct = $resProducts->GetNext()){
		$prodId = $arProduct['ID'];
		$arAllProducts[$prodId] = array(
			'NAME' => $arProduct['NAME'],
			'PRICE' => $arProduct['PROPERTY_PRICE_VALUE'],
			'MATERIAL' => $arProduct['PROPERTY_MATERIAL_VALUE'],
			'ARTNUMBER' => $arProduct['PROPERTY_ARTNUMBER_VALUE'],
		);

		$IBLOCK_SECTION_ID = $arProduct['IBLOCK_SECTION_ID'];
		foreach($arAllSection[$IBLOCK_SECTION_ID]['NEWS'] as $newsId){
			$arAllNews[$newsId]['PRODUCTS'][] = $prodId;

			if(!in_array($IBLOCK_SECTION_ID, $arAllNews[$newsId]['SECTIONS'])){
				$arAllNews[$newsId]['SECTIONS'][] = $IBLOCK_SECTION_ID;
			}
		}
	}

	$arResult['ITEMS'] = $arAllNews;
	$arResult['ALL_PRODUCTS'] = $arAllProducts;
	$arResult['ALL_SECTIONS'] = $arAllSection;
	$arResult['COUN_PRODUCTS'] = count($arAllProducts);

	$this->SetResultCacheKeys(array('COUN_PRODUCTS'));

	$this->includeComponentTemplate();	

}

$APPLICATION->SetTitle(GetMessage('SET_TITLE').$arResult['COUN_PRODUCTS']);
?>