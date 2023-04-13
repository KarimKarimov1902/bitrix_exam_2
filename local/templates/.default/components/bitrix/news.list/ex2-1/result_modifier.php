<? 
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",
	"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0,0,0,10,26,2016)), 
);
$res_db = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$arResult["ITEMS_DATE_NOW"] = array();
while($res = $res_db->GetNext())
{
	$arResult["ITEMS_DATE_NOW"][] = $res;
}
$arResult["COUNT_DATE_NOW"] =  count($arResult["ITEMS_DATE_NOW"]);
$this->getComponent()->SetResultCacheKeys(array("COUNT_DATE_NOW"));
?>