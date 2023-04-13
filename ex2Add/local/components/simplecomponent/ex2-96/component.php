<?
if (! defined ( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true) die ();
use Bitrix\Main\Loader, Bitrix\Iblock;

if (!isset($arParams["CACHE_TIME"]))
{
	$arParams["CACHE_TIME"] = 36000000;
}

if (!$USER->IsAuthorized())
{
	ShowError (GetMessage("NO_AUTORIZ"));
	return;
}

$arParams["PRODUCTS_IBLOCK_ID"] = intval(trim($arParams["PRODUCTS_IBLOCK_ID"]));
if(!($arParams["PRODUCTS_IBLOCK_ID"] > 0))
{
	ShowError (GetMessage("NO_IBLOCK"));
	return;
}

$arParams["PROP_CODE"] = trim($arParams["PROP_CODE"]);
if( strlen($arParams["PROP_CODE"]) < 1)
{
	ShowError (GetMessage("NO_PROP_CODE"));
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

	// user
	$arOrderUser = array("id");
	$sortOrder = "asc";
	$arFilterUser = array(
		"ACTIVE" => "Y"
	);
	
	$arResult["USERS"] = array();
	$rsUsers = CUser::GetList($arOrderUser, $sortOrder, $arFilterUser); // выбираем пользователей
	while($arUser = $rsUsers->GetNext())
	{
		$arResult['USERS'][$arUser["ID"]] = $arUser["LOGIN"];
	}	

	//Вытаскиваем элементы
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
		"PREVIEW_TEXT",
		"PROPERTY_PRICE",
		"PROPERTY_MATERIAL",
		"PROPERTY_LIKEUSER",
		"PROPERTY_ARTNUMBER",
		"DETAIL_PAGE_URL",
		"PROPERTY_".$arParams["PROP_CODE"]
	);
	//LIKEUSER
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
	);

	$arSortElems = array (
		//"NAME" => "ASC"
	);

	$arResult["ELEMENTS"] = array();
	$arResult["ELEMENTS_ID"] = array();
	$rsElementElement = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
	while($arElement = $rsElementElement->GetNext())
	{	
		if (!empty($arElement["PROPERTY_".$arParams["PROP_CODE"]."_VALUE"]))
		{
			if ($arElement["PROPERTY_".$arParams["PROP_CODE"]."_VALUE"] == $USER->GetID()) {
				$arResult["LIKES_ID_CURRENT"][] = $arElement["ID"];
			}else{
				$arResult["LIKES_ID"][$arElement["ID"]][$arElement["PROPERTY_".$arParams["PROP_CODE"]."_VALUE"]] = $arResult['USERS'][$arElement["PROPERTY_".$arParams["PROP_CODE"]."_VALUE"]];
				$arResult["LIKES_ID2"][$arElement["PROPERTY_".$arParams["PROP_CODE"]."_VALUE"]][] = $arElement["ID"];
				$arResult["LIKES_ID_OTHER"][] = $arElement["ID"];
			}
		}
		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
		$arResult["ELEMENTS_ID"][] = $arElement["ID"];
	}

	$arResult["LIKES_ID_CURRENT"] = array_unique($arResult["LIKES_ID_CURRENT"]); // товары текущего пользователя
	$arResult["LIKES_ID_OTHER"] = array_unique($arResult["LIKES_ID_OTHER"]); // товары других пользователей

	foreach ($arResult["LIKES_ID_CURRENT"] as $key => $value) {
		if (in_array($value, $arResult["LIKES_ID_OTHER"])) {
			$arResult["LIKES_ID_OTHER2"][] = $value;
		}
	}

	foreach ($arResult["LIKES_ID_OTHER2"] as $k => $v) {
		$arResult["LIKES_ID_OTHER3"] = array_keys ($arResult["LIKES_ID"][$v]);
	}
	
	foreach ($arResult["LIKES_ID_OTHER3"] as $kk => $vv) {
		$arResult["LIKES_ID_OTHER4"] = $arResult["LIKES_ID2"][$vv];
	}
	$arResult["LIKES_ID_OTHER4"] = array_unique($arResult["LIKES_ID_OTHER4"]); 

	$arResult["COUNT_CLASSIFIER"] = count($arResult["LIKES_ID_CURRENT"]);

	//echo "<pre>"; print_r( $arResult ); echo "</pre>";

	$this->SetResultCacheKeys(array(
		"COUNT_CLASSIFIER",
	));
	
	$this->includeComponentTemplate();
} 
else 
{
	$this->abortResultCache();
}
$APPLICATION->SetTitle("Избранных элементов  - ".$arResult["COUNT_CLASSIFIER"]);