<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ех2-75");
?><h3>
[ех2-75] Проверка текста при изменении новости<br>
 </h3>
<div>
	 В /local/php_interface/include/handlers.php добавляем:
</div>
 <br>
 <br>
<div>
 <span style="font-family: Courier New; color: #00aeef;">AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("ExamHandlers", "OnBeforeIBlockElementAddHandler"));</span>
</div>
<div>
	 и
</div>
<div>
 <span style="font-family: Courier New; color: #00aeef;">AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ExamHandlers", "OnBeforeIBlockElementUpdateHandler"));<br>
 </span><br>
</div>
 <br>
 Далее по коду...<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>