<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

// [ex2-60] Добавить постраничную навигацию в созданный простой компонент - start
$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"]);
if($arParams["NEWS_COUNT"]<=0)
	$arParams["NEWS_COUNT"] = 20;

$arNavParams = array(
	"nPageSize" => $arParams["NEWS_COUNT"],
);
$arNavigation = CDBResult::GetNavParams($arNavParams);
//end



if ($this->StartResultCache(false, array($USER->GetUserGroupArray(), $arNavigation, isset($_GET['F']))))
{

	//[ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги»
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache('');
	
	// Добавить дополнительную фильтрацию элементов в созданный простой компонент «Каталог товаров».
	if(isset($_GET['F'])) $this->AbortResultCache();
	
	if(!$iblockProd = $arParams['PRODUCTS_IBLOCK_ID']) return false;
	if(!$iblockClassif = (int)$arParams['CLASSIF_IBLOCK_ID']) return false;
	if(!$detailTemplate = $arParams['DETAIL_TEMPLATE']) return false;
	if(!$propCode = trim($arParams['PROPERTY_CODE'])) return false;

	$propCode = 'PROPERTY_'.$propCode;

	$resClassif = CIBlockElement::GetList(
		array(), 
		array('IBLOCK_ID'=>$iblockClassif, 'CHECK_PERMISSIONS' => 'Y'),
		false, 
		array('nTopCount' => 1), 
		array('ID'), //select
	);
	if(!$resClassif->SelectedRowsCount()) return false;

	$arResult["IBLOCK_ID"] = $iblockProd;
	
	// Добавить отображение данных в шаблон сайта
	$filter = array('IBLOCK_ID'=>$iblockProd, 'ACTIVE' => 'Y', '!'.$propCode => false, 'CHECK_PERMISSIONS' => 'Y');
	if(isset($_GET['F'])){
		$filter[] = array(
			'LOGIC' => 'OR',
			array('<=PROPERTY_PRICE' => 1700, 'PROPERTY_MATERIAL' => "Дерево, ткань"),
			array('>PROPERTY_PRICE' =>1500, 'PROPERTY_MATERIAL' => "Металл, пластик"),
		);
	}

	
	$maxPrice = "0";
	$minPrice = "99999999";

	$arAllProducts = array();
	$arItems = array();
	$resProducts = CIBlockElement::GetList(
		Array("name"=>"desc","sort"=>"asc"), 
		$filter,
		false, 
		$arNavParams, 
		array('ID', 'NAME', 'EDIT_LINK', 'CODE', 'IBLOCK_SECTION_ID', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER',
		$propCode, $propCode.'.NAME'), //select
	);

	while($arProduct = $resProducts->GetNext()){
		
		$prodId = $arProduct['ID'];

		$arButtons = CIBlock::GetPanelButtons(
			$iblockProd,
			$prodId,
			0,
			array("SECTION_BUTTONS" => false, "SESSID" => false)
		);
		// Добавить отображение данных в шаблон сайта
		$price = $arProduct['PROPERTY_PRICE_VALUE'];
		if($price < $minPrice ) $minPrice = $price;
		if($price > $maxPrice) $maxPrice = $price;
  
		// Добавить управление элементами – «Эрмитаж» в созданный простой компонент «Каталог товаров»

		if(!isset($arAllProducts[$prodId])){
			$arAllProducts[$prodId] = array(
				'NAME' => $arProduct['NAME'],
				'PRICE' => $arProduct['PROPERTY_PRICE_VALUE'],
				'MATERIAL' => $arProduct['PROPERTY_MATERIAL_VALUE'],
				'ARTNUMBER' => $arProduct['PROPERTY_ARTNUMBER_VALUE'],
				'LINK' => str_replace(
					array("#SECTION_ID#", "#ELEMENT_CODE#", "#ELEMENT_ID#"),
					array($arProduct['IBLOCK_SECTION_ID'], $arProduct['CODE'], $prodId),
					$detailTemplate
				),
				"EDIT_LINK" => $arButtons["edit"]["edit_element"]["ACTION_URL"],
				"DELETE_LINK" => $arButtons["edit"]["delete_element"]["ACTION_URL"],
			);
		}
		
		$classifId = $arProduct[$propCode.'_VALUE'];
		
		if(!isset($arItems[$classifId])){
			$arItems[$classifId] = array(
				'NAME' => $arProduct[$propCode.'_NAME'],
				'PRODUCTS' => array($prodId),
			);
		} else {
			$arItems[$classifId]['PRODUCTS'][] = $prodId;
		}

	}

	// [ex2-60] Добавить постраничную навигацию в созданный простой компонент - start
	$arResult["NAV_STRING"] = $resProducts->GetPageNavString(
		$arParams["PAGER_TITLE"],
		$arParams["PAGER_TEMPLATE"],
		$arParams["PAGER_SHOW_ALWAYS"],
		$this,
	);
	$arResult["NAV_CACHED_DATA"] = null;
	$arResult["NAV_RESULT"] = $resProducts;
	$arResult["NAV_PARAM"] = null;
	// end

	$arResult['ITEMS'] = $arItems;
	$arResult['ALL_PRODUCTS'] = $arAllProducts;
	$arResult['COUN_SECTIONS'] = count($arItems);

	// Добавить дополнительную фильтрацию элементов в созданный простой компонент «Каталог товаров».
	if(!isset($_GET['F'])){
		$url = $APPLICATION->GetCurPage()."?F=Y";
		$arResult['FILTER_LINK'] = '<a href="'.$url.'">'. $url . '</a>';
	}
	
	

	$arButtons = CIBlock::GetPanelButtons(
		$iblockProd,
		0,
		0,
		array("SECTION_BUTTONS"=>false, "SESSID"=>false)
	);
	$arResult["ADD_ELEMENT_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];

	//Добавить пункт «ИБ в админке» в выпадающем меню компонента.
	$res = CIBlock::GetByID($iblockProd);
	$ar_res = $res->GetNext();

	$this->AddIncludeAreaIcon(
		array(
			'URL'   =>"/bitrix/admin/iblock_element_admin.php?IBLOCK_ID=".$iblockProd."&type=".$ar_res['IBLOCK_TYPE_ID']."&lang=ru&find_el_y=Y&clear_filter=Y&apply_filter=Y",
			'TITLE' => GetMessage("IB_V_ADMIN"),
			"IN_PARAMS_MENU" => true
		)
	);

	// Добавить отображение данных в шаблон сайта
	$arResult['MAX_PRICE'] = $maxPrice;
	$arResult['MIN_PRICE'] = $minPrice;

	
	// Добавить отображение данных в шаблон сайта
	$this->SetResultCacheKeys(array('COUN_SECTIONS','MIN_PRICE', 'MAX_PRICE'));
	
	$this->includeComponentTemplate();	
	
	//[ex2-107] Автоматический сброс кеша в компоненте при изменении элемента информационного блока «Услуги»
	$CACHE_MANAGER->RegisterTag('iblock_id_'.SEVICE_IBLOCK);
	$CACHE_MANAGER->EndTagCache();
}

	$APPLICATION->SetTitle(GetMessage('SET_TITLE').$arResult['COUN_SECTIONS']);
?>