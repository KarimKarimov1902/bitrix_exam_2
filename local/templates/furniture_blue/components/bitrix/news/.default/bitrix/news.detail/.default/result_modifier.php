<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(isset($arParams['IBLOCK_CANONICAL']) && $bid = (int) $arParams['IBLOCK_CANONICAL']){

    $res = CIBlockElement::GetList(
        array("SORT"=>"ASC"),
        array("IBLOCK_ID"=>$bid, "ACTIVE"=>"Y", "PRPERTY_NEW" => $arResult['ID']),
        false,
        array('nTopCount',1),
        array('ID', "NAME")
    );

    if($fields = $res->Fetch()){
        $this->getComponent()->SetResultCacheKeys(array('CANONICAL_LINK'));
        $arResult['CANONICAL_LINK'] = $fields['NAME'];
    }
}
?>