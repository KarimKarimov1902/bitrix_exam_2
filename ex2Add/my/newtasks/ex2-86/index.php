<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-86");
?><h3>[ех2-86] Проверка количества пользователей на сайте</h3>
 Создаем агента:<br>
 <img src="/upload/medialibrary/730/73020e27dc9870ff3dff5af22ad083f0.png"><br>
 <br>
 <br>
 В /local/php_interface/include/agents.php размещаем:<br>
 <br>
<div>
 <span style="color: #00aeef; font-family: Courier New;">function ExamCheckCount()</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	{</span><br>
	 &nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	$rsAdmins = CUser::GetList($by = "ID", $order = "ASC", array("ID" =&gt; 1))-&gt;fetch();</span><br>
	 &nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">CEvent::Send(</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"COUNT_REGISTERED_USERS",</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"s1",</span>
</div>
<div>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp; array(</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"EMAIL_TO" =&gt; $rsAdmins["EMAIL"],</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"MESSAGE" =&gt; "На сайте зарегистрировано ".CUser::GetCount()." пользователей",</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	),</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"Y",</span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"29"</span><br>
	 &nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	);</span><br>
 <span style="color: #00aeef; font-family: Courier New;"> </span><br>
	 &nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	return "ExamCheckCount();";</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	}</span>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>