<?
//ссылка "назад" должна строится на основании данных компоненты
dump($arResult);
?>
Страница экзамена: <a href="<?=$url?>"><?=$url?></a>

<?
//получение значения переменных должны лежать в $arResult["VARIABLES"] не зависимо от режима работы компонента, ЧПУ/ не ЧУП 
//Переменная PARAMx $arResult["VARIABLES"]["PARAMx"]
?>
<br>Параметр 1: <?=$arResult["VARIABLES"]["PARAM1"]?>
<br>Параметр 2: <?=$arResult["VARIABLES"]["PARAM2"]?>

  