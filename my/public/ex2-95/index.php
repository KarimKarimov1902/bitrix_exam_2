<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-95");
?><h3>
[ex2-95] Упростить меню в административном разделе для контент-менеджера <br>
 </h3>
<div>
	 В адм. Разделе добавляем пользователя с логином <b>manager</b> и группой <b>Контент-редактор</b>. <br>
</div>
<div>
 <br>
</div>
<div>
	 В /local/php_interface/include/handlers.php пишем хэндлер:<br>
</div>
<div>
 <br>
</div>
<div>
 <span style="color: #00aeef; font-family: Courier New;">AddEventHandler("main", "OnBuildGlobalMenu", Array("ExamHandlers", "OnBuildGlobalMenuHandler"));</span>
</div>
<div>
 <span style="color: #00aeef; font-family: Courier New;"><br>
 </span>
</div>
<div>
	 Ну и дальнейшая магия в самом теле файла.<span style="color: #00aeef; font-family: Courier New;"><br>
 </span>
</div>
<div>
 <br>
	 Переходим в Контент -&gt; Типы инфоблоков, заходим в тип Товары и услуги: ИБ <b>Продукция</b>, <b>Услуги</b> и <b>Вакансии</b> -&gt; Доступы, для Контент-редактора – <b>по умолчанию</b> (либо - <b>нет доступа</b>).<br>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>