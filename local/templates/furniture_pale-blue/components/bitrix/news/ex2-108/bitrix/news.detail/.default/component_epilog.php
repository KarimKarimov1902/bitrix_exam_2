<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(isset($arParams['CANONICAL'])){
      $APPLICATION->SetPageProperty("canonical", $arResult['CANONICAL']['NAME']);
}