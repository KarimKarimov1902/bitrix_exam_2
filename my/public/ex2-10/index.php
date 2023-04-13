<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-10");
?><p>
	 Создать раздел /ex2/time_control/
</p>
<p>
	 Перейти на страницу Настройки &gt; Производительность &gt; Панель производительности
</p>
<p>
	 Нажать на кнопку Тест производительности запустить хотя бы на 1 мин
</p>
<p>
	 Во время теста нужно открыть все ссылки из верхнего меню по несколько раз.
</p>
<p>
	 Выписать из результата самую долгую страницу, указав ее долю % в общей статистике нагрузки.
</p>
 <br>
<hr>
<p>
 <span style="font-family: Courier New;">&lt;?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	$APPLICATION-&gt;SetTitle("Оценка производительности 2"); </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	?&gt;&lt;h2&gt;Нагрузка&lt;/h2&gt; </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	Страница:&nbsp;</span><a href="<a href=" http:="" bitrix-ex2-ttall="" bitrix="" admin=""><span style="font-family: Courier New;">/products/index.php"&gt;http://bitrix-ex2-ttall/bitrix/admin/perfmon_hit_list.php?lang=ru&amp;set_filter=Y&amp;find_script_name=%2Fb...</span></a><br>
	<span style="font-family: Courier New;"> </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	Доля:&amp;nbsp;20.53%&lt;br&gt; </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	&lt;h2&gt;САМЫЙ НАГРУЖАЕМЫЙ КОМПОНЕНТ&lt;/h2&gt; </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	Название:&amp;nbsp;bitrix:catalog&lt;br&gt; </span>
</p>
<span style="font-family: Courier New;"> </span>
<p>
	<span style="font-family: Courier New;">
	Время:&amp;nbsp;0.0773 с&lt;br&gt;&lt;?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?&gt; </span>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>