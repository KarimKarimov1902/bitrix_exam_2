<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-90");
?><?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-90",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "news"
	)
);?><br>
<hr>
<p>
	 В ИБ Услуги (ID-3) создаем три раздела (Раздел 1, Раздел 2, Раздел 3).
</p>
<p>
	 В ИБ Продукция (ID-2) создаем свойство - <b>Альтернативный классификатор</b>;
</p>
<p>
	 Тип: <b>привязка к разделам</b>;
</p>
<p>
	 Код: <b>ALTERCLASS</b>;
</p>
<p>
	 Множественное: <b>Да</b>;
</p>
<p>
	 Инфоблок: <b>Товары и услуги &lt;-----&gt; Услуги</b>.
</p>
<p>
	 В информационном блоке Продукция задать у нескольких элементов значение множественного свойства Альтернативный классификатор, как на рисунке: <br>
</p>
<p>
 <img src="/upload/medialibrary/9cf/9cf8a7c4d35ab688ee663467abe129ec.png">
</p>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>