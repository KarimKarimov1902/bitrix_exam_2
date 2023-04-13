<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-77");
?><h3>[ех2-77] Разработать простой компонент «Каталог товаров»</h3>
<div>
	 Создаём инфоблок <i>Альтернативный классификатор</i>. <br>
</div>
<div>
	 В нём - 2 раздела: <b>Раздел 1, Раздел 2.</b><b> </b>
</div>
 <b> </b>
<div>
 <b> </b>
</div>
<div>
	 Добавляем <i>Пользовательское поле&nbsp; - <b>"</b></i><b>Альтернативный классификатор"</b>
</div>
<div>
	 &nbsp;&nbsp;&nbsp; - Тип: <b>Привязка к разделам ИБ;</b>
</div>
<div>
 <b>&nbsp;&nbsp;&nbsp; </b>- Объект: <b>IBLOCK_2_SECTION;</b>
</div>
<div>
 <b>&nbsp;&nbsp;&nbsp; </b>- Код поля: <b>UF_NEW_CLASSIFIER;</b>
</div>
<div>
 <b>&nbsp;&nbsp;&nbsp;</b> - Инфоблок: <b>Товары и Услуги, </b><b>Альтернативный классификатор.</b>
</div>
<div>
 <img src="/upload/medialibrary/d25/d25aa4ac9515fe9c170b9491fccbc2de.png" height="536" width="717">
</div>
<h3><span style="color: #00a650;">Собственно, сам компонент:</span></h3>
 <br>
 <?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-77",
	".default",
	Array(
		"ALTER_IBLOCK_ID" => "12",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CLASSIFIER_PROP_CODE" => "UF_LINK_SECTION_SING",
		"CODE_ALTER" => "UF_NEW_CLASSIFIER",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_CLASSIFIER_ID" => "1",
		"IBLOCK_ID" => "2",
		"PRODUCTS_IBLOCK_ID" => "2"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>