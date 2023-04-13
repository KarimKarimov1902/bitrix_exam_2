<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(isset($_REQUEST['ajax_action']) && ($_REQUEST['ajax_action']== "getdata")  )
{
	$APPLICATION->RestartBuffer();
	
	$elemId = intval($_REQUEST['elementid']);
	$resData = "";
	$resStat = "START";
	if( ($elemId > 0) && CModule::IncludeModule("iblock"))
	{
		$rsResElem = CIBlockElement::GetByID($elemId);
		if($arResElem = $rsResElem->GetNext())
		{
			$resData = $arResElem["TIMESTAMP_X"];
			$resStat = "OK";
		}
		else
		{
			$resStat = "ERROR";
		}
	}
	echo CUtil::PhpToJSObject(array(
			'RESULT_STAT' => $resStat,
			'RESULT_DATA' => $resData,
	));
	die();
}

?>
