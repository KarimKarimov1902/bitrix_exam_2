<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-97");
?><h3>
[ex2-97] Разработать простой компонент «Новости по интересам» <br>
 </h3>
 &nbsp;<br>
 Создаем пользовательское поле: <br>
 Тип: <b>Список</b>; <br>
 Объект: <b>USER</b>; <br>
 Код поля: <b>UF_AUTHOR_TYPE</b>; <br>
 Множественное: <b>Нет</b>; <br>
 Языковые настройки: <b>Тип автора</b>. <br>
 Список: <br>
 - <b>Группа авторов 1</b> (по умолчанию); <br>
 - <b>Группа авторов 2</b>. <br>
 Добавляем трех пользователей – <b>test1</b>, <b>test2</b>, <b>test3</b>. <br>
 Пользователямм test1, test2 и admin устанавливаем созданное нами пользовательское поле (во вкладке – Доп. поля) – Группа авторов 1, а пользователю test3 - Группа авторов 2. <br>
 В ИБ Новости создаем свойство <b>Автор</b>: <br>
 Тип: <b>привязка к пользователю</b>; <br>
 Множественное: <b>Да</b>; <br>
 Код: <b>AUTHOR_CODE</b>. <br>
 В ИБ Новости добавляем три новости: <br>
 - <b>Тестовая новость №1, Автор – test3</b>; <br>
 - <b>Тестовая новость №2, Автор – test2, test3</b>; <br>
 - <b>Тестовая новость №3, Автор – admin, test2</b>. <br>
 Существующим новостям присваиваем следующих авторов: <br>
 - Получено прочное водостойкое соединение – admin; <br>
 - Мебельный форум Беларуси – test1; <br>
 - Международная мебельная выставка SALON DEL MOBILE – test1, test2.<br>
 <br>
 <b>Настраиваем параметры</b>: <br>
 ID инфоблока с новостями – <b>1</b>; <br>
 Код свойства информационного блока, в котором хранится Автор – <b>AUTHOR_CODE</b>; <br>
 Код пользовательского свойства, в котором хранится тип автора - <b>UF_AUTHOR_TYPE</b>.
<h3><span style="color: #00a650;">Собственно, вывод компонента:</span></h3>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-97",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"FIELD_AUTHOR_CODE" => "UF_AUTHOR_TYPE",
		"NEWS_IBLOCK_ID" => "1",
		"PROPERTY_AUTHOR_CODE" => "AUTHOR_CODE"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>