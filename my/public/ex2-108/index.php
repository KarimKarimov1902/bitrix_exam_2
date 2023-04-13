<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-108");
?><h3>
[ex2-108] link rel="canonical" для детальной новости <br>
 </h3>
 <br>
 Создаем ИБ типа Новости: <br>
 &nbsp;- символьный код – <b>Canonical</b>; <br>
 &nbsp;- название – <b>Canonical</b>; <br>
 &nbsp;- доступ, для всех пользователей – <b>Чтение</b>. <br>
 Создаем свойство ИБ с названием <b>Новость</b>; <br>
 &nbsp;- тип – <b>привязка к элементам;<br>
 &nbsp;</b>- код: <b>NEWS_MY;</b> <br>
 &nbsp;- информационный блок: <b>Новости</b>, тип – <b>Новости</b>. <br>
 <br>
 Открываем ИБ «Canonical» и Добавляем элемент с названием:<a href="http://test.ru/test/">http://test.ru/test/</a>, <br>
 новость: <b>[2] Международная мебельная выставка SALON DEL MOBILE</b>. <br>
 <br>
 Если не скопированы:<br>
 &nbsp;&nbsp;&nbsp; Копируем шаблон furniture_pale-blue в папку local. <br>
 &nbsp;&nbsp;&nbsp; Копируем папку .default из /www/bitrix/components/bitrix/news/templates/ в /local/templates/furniture_pale-blue/components/bitrix/news/. <br>
 <br>
 В /www/local/templates/furniture_pale-blue/components/bitrix/news/.default/.parameters.php добавляем: <br>
 <span style="color: #00aeef; font-family: Courier New;">"CANONICAL" =&gt; Array( </span><br>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp;&nbsp; "NAME" =&gt; GetMessage("CANONICAL"), </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
), </span><br>
 <br>
 В файле .parameters.php папки lang/ru добавляем параметр: <br>
 <span style="color: #00aeef; font-family: Courier New;">$MESS["CANONICAL"] = "ID информационного блока для rel=canonical";</span> <br>
 <br>
 В /www/local/templates/furniture_pale-blue/components/bitrix/news/.default/detail.php в массив вызова компонента bitrix:news.detail добавляем (после "IBLOCK_URL"): <br>
 <span style="font-family: Courier New; color: #00aeef;">"CANONICAL" =&gt; $arParams["CANONICAL"] </span><br>
 <br>
 В /www/local/templates/furniture_pale-blue/header.php добавляем: <span style="color: #00aeef; font-family: Courier New;">&lt;?$APPLICATION-&gt;ShowProperty("canonical");?&gt; </span><br>
 <br>
 Создаем result_modifier.php в /www/local/templates/furniture_pale-blue/components/bitrix/news/.default/bitrix/news.detail/.default/result_modifier.php с содержимым: <br>
 <span style="font-family: Courier New; color: #00aeef;">if($arParams['CANONICAL']){ </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp; $arFilter = array('IBLOCK_ID'=&gt;$arParams['CANONICAL'],'PROPERTY_ NEWS_MY' =&gt; $arResult['ID']); </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp; $arSelect = array('ID','IBLOCK_ID','NAME','PROPERTY_ NEWS_MY'); </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp; $r = CIBlockElement::GetList(array(),$arFilter,false,false,$arSelect); </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp; if($res = $r -&gt; Fetch()){ </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arResult['CANONICAL'] = $res; </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp; } </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
&nbsp;&nbsp; $this-&gt;__component-&gt;SetResultCacheKeys(array('CANONICAL')); </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
} <br>
 <br>
 </span>
Создаем component_epilog.php с содержимым: <br>
 <span style="color: #00aeef; font-family: Courier New;">if(isset($arParams['CANONICAL'])){ </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $APPLICATION-&gt;SetPageProperty("canonical", $arResult['CANONICAL']['NAME']); </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
}</span><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>