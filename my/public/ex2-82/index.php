<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-82");
?><h3>
[ex2-82] Добавить отображение данных в шаблон сайта <br>
 </h3>
<div>
	<a href="/my/oldtasks/actual/ex2-57/">Это задание схоже с </a><a href="/my/oldtasks/actual/ex2-57/">ex2-57</a>
</div>
<a href="http://192.168.10.26/my/oldtasks/actual/ex2-57/"></a><br>
 <br>
 Если это компонент из задания [ex2-70]: <br>
 <br>
 Создаем .../templates/.default/result_modifier.php с магией.<br>
 Создаем .../templates/.default/component_epilog.php с магией.<br>
 <br>
 В /local/templates/furniture_pale-blue/header.php, перед <br>
 &lt;div class="information-block"&gt; пишем: <br>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?$APPLICATION-&gt;ShowViewContent('prices');?&gt;</span><br>
<h4><span style="color: #00a650;">Ну и, сам компонент:</span></h4>
 <br>
<?$APPLICATION->IncludeComponent(
	"simplecomponent:ex2-82_70",
	".default",
	Array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCT_IBLOCK_ID" => "2",
		"PROPERTY_NEWS_CODE" => "UF_NEWS_LINK"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>