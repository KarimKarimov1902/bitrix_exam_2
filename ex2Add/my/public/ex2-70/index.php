<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-70");
?><h3>[ex2-70] Разработать простой компонент «Каталог товаров» </h3>
<p>
</p>
<div>
	 Копируем из материалов простой компонент. <br>
	 В адм. разделе, Контент – Товары и услуги – Продукция, жмём на сендвич – Изменить, вкладка Доп. Поля - Добавить пользовательское свойство. <br>
	 Либо просто добавить пользовательское поле с объектом - IBLOCK_2_SECTION. <br>
	 Тип: <b>привязка к элементам ИБ</b>; <br>
	 Код: <b>UF_NEWS_LINK</b>; <br>
	 Множественное: <b>Да</b>; <br>
	 Инфоблок: <b>Новости, Новости</b>; <br>
	 Языковые настройки: <b>UF_NEWS_LINK</b>. <br>
	 Выбираем все разделы ИБ Продукция и устанавливаем как на рисунке:
</div>
 <img src="/upload/medialibrary/357/357dfbf5463edc713d4a602012f39e74.png" height="368" width="567">
<p>
</p>
<p>
</p>
<div>
 <b>Настраиваем параметры: </b><br>
	 ID ИБ товаров – <b>2</b>; <br>
	 ID ИБ новостей – <b>1</b>; <br>
	 Код пользовательского свойства разделов каталога - <b>UF_NEWS_LINK</b>. <br>
</div>
<div>
 <br>
</div>
<h3><span style="color: #00a650;">Собственно, вывод компонента:</span><br>
 </h3>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-70",
	"",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_NEWS_CODE" => "UF_NEWS_LINK"
	)
);?>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>