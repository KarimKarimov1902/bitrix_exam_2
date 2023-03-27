<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetPageProperty('h1',GetMessage('H1').$arResult['COUN_SECTIONS']);
//Добавить отображение данных в шаблон сайта
$APPLICATION->SetPageProperty('simplecomp_exam', '<div style="color:red; margin: 34px 15px 35px 15px">'.GetMessage('MAX_PRICE').$arResult['MAX_PRICE']."</br>". GetMessage('MIN_PRICE').$arResult['MIN_PRICE'] .'</div>');
?>