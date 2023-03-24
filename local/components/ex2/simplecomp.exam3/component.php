<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if(intval($arParams["NEWS_IBLOCK_ID"]) > 0 && $this->StartResultCache(false, array($USER->GetID)))
{
	if(!$newsIblockId = (int)$arParams['NEWS_IBLOCK_ID']) return false;
	
	if(!$nPropCode = trim($arParams['NEWS_PROP_CODE'])) return false;
	
	if(!$typeAuthor = trim($arParams['TYPE_AUTHOR_PROP_CODE'])) return false;

	if(!$USER->Authorize($USER->GetID())) return false;


	$arParams["SELECT"] = array($typeAuthor);
	$arRes = CUser::GetList([],[],array("ID" => $USER->GetID()),$arParams);
	$groupUser = '';
    if ($res = $arRes->Fetch()) {
        $groupUser = $res[$typeAuthor];
    }

	// user
	$arFilterUser = array(
		"ACTIVE" => "Y",
		"=".$typeAuthor => $groupUser,
		"!ID" =>$USER->GetID(),
	);

	$arParams["FIELDS"] = array("ID","LOGIN");
	$arParams["SELECT"] = array($typeAuthor);
	
	$arResult["USERS"] = array();
	$userIds = array();
	$rsUsers = CUser::GetList(array(), array(), $arFilterUser,$arParams); // выбираем пользователей
	while($arUser = $rsUsers->GetNext())
	{
		$arResult["USERS"][$arUser['ID']] =$arUser;
		$userIds[] = $arUser['ID'];
	}	

	$newsProp = 'PROPERTY_'.$nPropCode;
	//iblock elements
	$arSelectElems = array (
		"ID",
		"NAME",
		"ACTIVE_FROM",
		$newsProp,
	);
	$newsProp = '=PROPERTY_'.$nPropCode;
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
		"ACTIVE" => "Y",
		$newsProp => $userIds,
		"PERMISSIONS_BY" => $USER->GetID()
	);

	$arResult["ELEMENTS"] = array();
	$rsElements = CIBlockElement::GetList(array(), 
		$arFilterElems, 
		false, 
		false, $arSelectElems);
	while($arElement = $rsElements->GetNext())
	{
		$arResult["ELEMENTS"][] = $arElement;
	}

	foreach($arResult["ELEMENTS"] as $key=>$element){
		$arResult["USERS"][$element['PROPERTY_AUTHOR_VALUE']]['ELEMENTS'][] = $element;
	}
		
	$arResult['COUNT_NEWS'] = count($arResult['ELEMENTS']);


	$this->SetResultCacheKeys(array("COUNT_NEWS"));
}

$APPLICATION->SetTitle(GetMessage("SET_TITLE"). $arResult['COUNT_NEWS']);

$this->includeComponentTemplate();	
?>