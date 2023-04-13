<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-94");
?><h3>[ex2-94] Супер инструмент SEO специалиста </h3>
 Согласно заданию: создаем ИБ <b>«Метатеги»,</b> добавляем свойства, создаем два элемента. <br>
 <br>
 Определяем константу IBLOCK_META в /local/php_interface/include/constants.php: <br>
 <span style="color: #00aeef; font-family: Courier New;">define('IBLOCK_META', 11);</span> // в данном случае <br>
 <br>
 В /local/php_interface/include/handlers.php:<br>
 <span style="color: #00aeef; font-family: Courier New;">AddEventHandler("main", "OnBeforeProlog", array("ExamHandlers", "MyOnBeforePrologHandler"), 50);</span><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>