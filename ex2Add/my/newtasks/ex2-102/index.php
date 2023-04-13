<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-102");
?><h3>
[ex2-102] Добавить англоязычную версию сайта (один инфоблок) </h3>
<p>
</p>
<div>
	 В Админке (Настройки продукта – Сайты – Список сайтов) создаем новый сайт: <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ID: <b>s2</b>; <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Название: <b>Второй сайт</b>; <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - По умолчанию:<b> Да</b>; <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Папка сайта: <b>/ex2/site2/ </b>(<span style="color: #ff0000;">Уже должно быть!</span>); <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Название веб-сайта: <b>Второй сайт</b>; <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Язык: <b>EN</b>; <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Региональные настройки: <b>EN</b>. <br>
</div>
<hr>
<div>
	 Из материалов копируем файлы <b>about.php</b> в папку /ex2/site2/ и <b>motto.php</b> в папку /ex2/site2/include/. <br>
</div>
 <br>
 <br>
<div>
	 Находясь на Втором сайте редактируем верхнее меню, удалив все пункты и добавив – <b>Main</b> (/ex2/site2/index.php) и <b>About</b> (/ex2/site2/about.php). <br>
</div>
 <br>
 <br>
<div>
	 Если в local не скопирован шаблон основного сайта (<b>furniture_pale-blue</b>), то копируем его и папку <b>.default</b> из /www/bitrix/templates/. Из материалов, в /local/templates/, так же копируем папку <b>ex2_multilang_template_materials</b>. <br>
</div>
 В Админке, (Настройки продукта – Сайты – Список сайтов – s2), Шаблон сайта – «<b>ex2-102 материалы</b>». <br>
<div>
 <br>
</div>
<div>
 <br>
</div>
 Из header.php основного шаблона, копируем в header.php шаблона ex2_multilang_template_materials (в тег &lt;td id="banner-slogan"&gt;) код слогана: <br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;? </span><br>
 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
$APPLICATION-&gt;IncludeFile( </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp; SITE_DIR."include/motto.php", </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp; Array(), </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp; Array("MODE"=&gt;"html") </span><br>
 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
); </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
?&gt; <br>
 <br>
 </span>
В ИБ «Новости» ставим галочку - Сайты: <b>[</b><b>s2</b><b>] Второй сайт</b>. Добавляем два свойства: <br>
 - Название на английском (строка), код: <b>NAME_EN</b>; <br>
 - Анонс на английском (HTML /текст) ), код: <b>PREVIEW_TEXT_EN</b>. <br>
 <br>
 В элементах ИБ «Новости» ставим поле <b>«Название на английском»</b> под поле <b>«Название»</b>. Заполняем созданные свойства ИБ согласно заданию. <br>
 <img src="/upload/medialibrary/b81/b81b1f0297051d798f4037591e2fe762.png" height="210" width="609"><br>
 <br>
 В /local/templates/.default/components/bitrix/ создаем папку <b>news</b> (если не создана) и туда копируем папку <b>.default</b> из /bitrix/components/bitrix/news/templates/. <br>
 <br>
 С индексной страницы Второго сайта удаляем всё и размещаем комплексный компонент NEWS. <br>
 В настройках компонента: <br>
 - Date display format: <b>Site date format</b>; <br>
 - Снимаем галочку с <b>Set page title</b>; <br>
 - Выбираем наши свойства в поле – <b>Properties</b>.<br>
<hr>
<p>
	 Кастомизируем шаблон компонента NEWS в файле /local/templates/.default/components/bitrix/news/.default/bitrix/news.list/.default/template.php: <br>
</p>
<hr>
<p>
</p>
<p>
</p>
<p>
</p>
<p>
	 Из компонента /www/bitrix/components/bitrix/main.site.selector/templates/ копируем папки dropdown и .default в /local/templates/.default/components/bitrix/main.site.selector/
</p>
<p>
</p>
<p>
</p>
<div>
	В header.php обоих шаблонов размещаем вызовы компонента переключения сайтов: <br>
</div>
<div>
 <br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?$APPLICATION-&gt;IncludeComponent( </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; "bitrix:main.site.selector", </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; "dropdown", </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; Array( </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "SITE_LIST" =&gt; array(), </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "CACHE_TYPE" =&gt; "A", </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "CACHE_TIME" =&gt; "3600" </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; ), </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; false </span><br>
	<span style="color: #00aeef; font-family: Courier New;">
	);?&gt; </span><br>
</div>
<div>
 <br>
	 В шаблоне компонента /local/templates/.default/components/bitrix/main.site.selector/dropdown/template.php заменяем <br>
</div>
<div>
	<span style="color: #00aeef; font-family: Courier New;">&lt;?=$arSite["NAME"]?&gt;</span> на <span style="color: #00aeef; font-family: Courier New;">&lt;?=$arSite["LANG"]?&gt;</span>.
</div>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>