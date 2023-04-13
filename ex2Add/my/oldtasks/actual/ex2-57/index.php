<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-57");
?><h3><span style="color: #00a650;"><a href="/my/public/ex2-82/">Это задание схоже с ex2-82</a></span><span style="color: #00a650;"> </span></h3>
 <br>
 <br>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-57",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "products"
	)
);?><br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>