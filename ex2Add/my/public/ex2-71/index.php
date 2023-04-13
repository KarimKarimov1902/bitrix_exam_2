<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-71");
?><p>
</p>
<h3>
[ex2-71] Разработать простой компонент «Каталог товаров» </h3>
<div>
	 Создаем ИБ «<b>Фирма – производитель</b>» (в типе ИБ «Товары и услуги») и в нем три элемента. Элементы называем произвольными названиями фирм, например: <b>Фирма1</b>, <b>Фирма2</b> и пр. <br>
</div>
<div>
 <br>
</div>
<div>
	 В ИБ «<b>Продукция</b>» создаем свойство «<b>Фирма</b>»; <br>
	 Код: <b>COMPANY</b>; <br>
	 Тип: <b>Привязка к элементам</b>; <br>
	 Множественное: <b>Да</b>; <br>
	 Информационный блок: <b>Товары и услуги, Фирма – производитель</b>. <br>
</div>
<div>
 <br>
</div>
<div>
	 В информационном блоке <b>Продукция</b> задаем у нескольких элементов значение множественного свойства Фирма, не менее чем у 4х товаров, привязав каждый товар к 2-3 элементам классификатора (фирмам).
</div>
 <br>
 <b>Настраиваем параметры:</b> <br>
 ID ИБ товаров – <b>2</b>; <br>
 ID ИБ фирм – <b>7</b>; <br>
 Код пользовательского свойства разделов каталога - <b>COMPANY_MULTY</b>.
<h3><span style="color: #00a650;">Собственно, вывод компонента:</span></h3>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-71",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"FIRMS_IBLOCK_ID" => "7",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_FIRMS_CODE" => "COMPANY_MULTY"
	)
);?>
<p>
</p>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>