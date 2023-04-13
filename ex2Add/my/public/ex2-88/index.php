<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-88");
?><h3>
[ex2-88] Оценить скорость работы сайта – страницы и созданный простой компонент «Каталог товаров»&nbsp;&nbsp; <br>
 </h3>
Создать раздел /ex2/time_control/ <br>
 Перейти на страницу Настройки &gt; Производительность &gt; Панель производительности <br>
 Нажать на кнопку Тест производительности запустить хотя бы на 1 мин <br>
 Во время теста нужно открыть все ссылки из верхнего меню по несколько раз. <br>
 Выписать из результата самую долгую страницу, указав ее долю % в общей статистике нагрузки. <br>
 Добавляйте или удаляйте данные для кеширования в component.php и следите как меняется размер кеша. <br>
&nbsp; <br>
 Определяем что будет кешироваться <br>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $this-&gt;setResultCacheKeys(array( </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "PRODUCT_COUNT", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "SECTIONS_COUNT", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "NEWS_GROUP", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "PRODUCT_GROUP_SECTION", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "SET_TITLE", </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )); <br>
<br>
</span>
Запишите результаты до и после. <br>
<br>
 В index.php, например так: <br>
<br>
<span style="color: #00aeef; font-family: Courier New;">
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
$APPLICATION-&gt;SetTitle("Оценка производительности"); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;">
?&gt;&lt;h2&gt;Нагрузка&lt;/h2&gt; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
Страница:&nbsp;</span><span style="color: #00aeef; font-family: Courier New;">/services/index.php"&gt;</span><a href="http://192.168.1.38/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fservi.."><span style="color: #00aeef; font-family: Courier New;">http://192.168.1.38/bitrix/admin/perfmon_hit_list.php?lang=ru&amp;set_filter=Y&amp;find_script_name=%2Fservi...</span></a><span style="color: #00aeef; font-family: Courier New;">.</span><span style="color: #00aeef; font-family: Courier New;">.</span><br>
<span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;">
Доля:&amp;nbsp;15.15%&lt;br&gt; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
&lt;h2&gt;КЕШ&lt;/h2&gt; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
По умолчанию: &lt;b&gt;258 кб&lt;/b&gt;&lt;br&gt; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;">
При помещении в него только данных, необходимых в некешируемой части: &lt;b&gt;245 кб&lt;/b&gt;&lt;br&gt; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
<span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;"> </span><span style="color: #00aeef; font-family: Courier New;">
&lt;?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?&gt; </span> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>