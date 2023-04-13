<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?


$arIDs = Array();

foreach($arResult["ITEMS"] as $arItem)
{
    $arIDs[$arItem["PROPERTIES"]["ITEM"]["VALUE"]] = $arItem["PROPERTIES"]["ITEM"]["VALUE"];
}

$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_TEXT", "PROPERTY_PRICE");
$arFilter = Array("ID" => $arIDs, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

$arItems = Array();

while($ob = $res->GetNext())
{
    $arItems[$ob["ID"]] = $ob;
}

$arResult["GOODS"] = $arItems;


?>