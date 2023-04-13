<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//адреса по умолчанию, если вдруг нету в параметрах 
$arDefaultUrlTemplates404 = array(
	"main" => "",
	"user" => "#USER_ID#user.php",
	"section" => "#SECTION_ID#/",
	"resume" => "#SECTION_ID#/#RESUME_ID#/",
	"userresume" => "#USER_ID#userresume.php?RES_ID=#RES_ID#",
);

$arComponentVariables = array(
	"USER_ID",
	"SECTION_ID",
	"RESUME_ID",
	"RES_ID",
);

$arDefaultVariableAliases404 = array();
$arDefaultVariableAliases = array();

$arVariables = array();

if($arParams["SEF_MODE"] == "Y")
{
	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);
		
	$engine = new CComponentEngine($this);
	
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);
	
	if(!$componentPage)
	{
		$componentPage = "main";
	}
		
	CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
	$arResult = array(
			"FOLDER" => $arParams["SEF_FOLDER"],
			"URL_TEMPLATES" => $arUrlTemplates,
			"VARIABLES" => $arVariables,
			"ALIASES" => $arVariableAliases,
			"PAGE" => $componentPage
	);
	
}
else 
{
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);
	
	if(
		(isset($arVariables["USER_ID"]) && intval($arVariables["USER_ID"]) > 0)
		&& (isset($arVariables["RESUME_ID"]) && intval($arVariables["RESUME_ID"]) > 0)
	) 
	$componentPage = "userresume";
	
	elseif(isset($arVariables["USER_ID"]) && intval($arVariables["USER_ID"]) > 0)
	$componentPage = "user";
	
	elseif(
		(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
		&& (isset($arVariables["RESUME_ID"]) && intval($arVariables["RESUME_ID"]) > 0)
	)
	$componentPage = "resume";
	
	elseif(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
	$componentPage = "section";	
	
	else
	$componentPage = "main";
		
	
	$arResult = array(
		"FOLDER" => "",
		"URL_TEMPLATES" => Array(
			"section" => htmlspecialcharsbx($APPLICATION->GetCurPage())."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#",
			"element" => htmlspecialcharsbx($APPLICATION->GetCurPage())."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"."&".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#",
			"compare" => htmlspecialcharsbx($APPLICATION->GetCurPage())."?".$arVariableAliases["action"]."=COMPARE",
		),
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases,
		"PAGE" => $componentPage
	);
	
}
dump($arResult);
$this->IncludeComponentTemplate($componentPage);

?>