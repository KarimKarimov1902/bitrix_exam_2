<?if($arParams['CANONICAL']){
	$arFilter = array('IBLOCK_ID'=>$arParams['CANONICAL'],'PROPERTY_NEWS_MY' => $arResult['ID']);
	$arSelect = array('ID','IBLOCK_ID','NAME','PROPERTY_NEWS_MY');
	$r = CIBlockElement::GetList(array(),$arFilter,false,false,$arSelect);
	if($res = $r->Fetch()){
		$arResult['CANONICAL'] = $res;
	}
	$this->__component->SetResultCacheKeys(array('CANONICAL'));
} 