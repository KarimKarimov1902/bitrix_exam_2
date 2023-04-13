<?
$cur_page = $APPLICATION->GetCurDir();
if(Bitrix\Main\Loader::includeModule('iblock')){
	$arFilter = array('IBLOCK_ID' => IBLOCK_META,'NAME' => $cur_page);
	$arSelect = array('IBLOCK_ID','ID','PROPERTY_TITLE','PROPERTY_DESC');
	$r = CIBlockElement::GetList([],$arFilter,false,false,$arSelect);
	if($res = $r->Fetch()){
		$APPLICATION->SetPageProperty('title', $res['PROPERTY_TITLE_VALUE']);
		$APPLICATION->SetPageProperty('description', $res['PROPERTY_DESC_VALUE']);
	}
}
