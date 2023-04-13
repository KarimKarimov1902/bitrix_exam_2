<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-62");
?><h3><span style="color: #00a650;">Схоже с заданием ex2-77</span></h3>
 <br>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-62", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CLASSIFIER_PROP_CODE" => "UF_SECTION",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_CLASSIFIER_ID" => "8",
		"IBLOCK_ID" => "2"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>