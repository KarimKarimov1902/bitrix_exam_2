<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams["POKAZ_COUNT"] == "Y")
{
	//ToDo убрать запрос и сортировать что есть 
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
	$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID" =>  $arResult["ELEMENTS"][0]);
	$res_db = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	$arResult["ITEMS_DATE_NOW"] = "";
	while($res = $res_db->GetNext())
	{
		$arResult["ITEMS_DATE_NOW"] = $res["DATE_ACTIVE_FROM"];
	}
	$this->getComponent()->SetResultCacheKeys(array("ITEMS_DATE_NOW"));
}
?>

