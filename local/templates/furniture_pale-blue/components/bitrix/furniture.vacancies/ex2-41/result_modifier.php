<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION, $USER;
foreach($arResult['ITEMS'] as $key=>$val)
{
	if(strtoupper($arResult['ITEMS'][$key]["PREVIEW_TEXT_TYPE"]) == "TEXT")
		$arResult['ITEMS'][$key]["PREVIEW_TEXT"] = nl2br($arResult['ITEMS'][$key]["PREVIEW_TEXT"]);
	if(strtoupper($arResult['ITEMS'][$key]["DETAIL_TEXT_TYPE"]) == "TEXT")
		$arResult['ITEMS'][$key]["DETAIL_TEXT"] = nl2br($arResult['ITEMS'][$key]["DETAIL_TEXT"]);
	
	//create button
	if($USER->IsAuthorized())
	{
		if($APPLICATION->GetShowIncludeAreas())
		{

			$ar = CIBlock::ShowPanel($arParams['IBLOCK_ID'], $val['ID'], 0, $arParams["IBLOCK_TYPE"], true);
			if(is_array($ar))
			{
				foreach($ar as $arButton)
				{
					if(preg_match("/[^A-Z0-9_]ID=\d+/", $arButton["URL"]))
					{
						$arButton["URL"] = preg_replace("/&return_url=(.+?)&/", "&", $arButton["URL"]);
						$arResult['ITEMS'][$key]['EDIT_BUTTON'] = '<a href="'.htmlspecialcharsbx($arButton["URL"]).'" title="'.htmlspecialcharsbx($arButton["TITLE"]).'"><img src="'.$arButton["IMAGE"].'" width="20" height="20" border="0" /></a>';
					}
				}
			}
		}
	}
}

// Далее ex2-41
$arResult["COUNT_VACANS"] = count($arResult['ITEMS']);
$obComponent = $this->GetComponent();
$obComponent->SetResultCacheKeys(array("COUNT_VACANS"));
?>