<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-92");
?><h3>[ex2-92] Задать особую индексацию для элементов инфоблока «Новости» </h3>
 • При индексации элементов информационного блока «Новости» заменять заголовок результата поиска на первые 50 символов текса анонса новости. <br>
 • Результат проверить в разделе сайта /search/, для проверки решения достаточно пересохранить один элемент информационного блока. <br>
 • Результат проверять на поиске новости с текстом «Salon del Mobile».<br>
<h3>Решение:</h3>
 <br>
 В /local/php_interface/include/handlers.php добавим:<br>
<br>
 <span style="color: #00aeef; font-family: Courier New;">AddEventHandler("search", "BeforeIndex", array("ExamHandlers", "myBeforeIndexHandler"));</span><br>
<span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
class ExamHandlers</span><br>
<span style="color: #00aeef; font-family: Courier New;">
{</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp; // ех2-92</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp; function myBeforeIndexHandler($arFields)</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp; {</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if(!CModule::IncludeModule("iblock")) // подключаем модуль</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return $arFields;</span><br>
<span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if($arFields["MODULE_ID"] == "iblock")</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arFields["TITLE"] = substr($arFields["BODY"], 0, 50)."...";</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; return $arFields; // Обязательно!!!</span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp; }</span><br>
<span style="color: #00aeef; font-family: Courier New;">}</span><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>