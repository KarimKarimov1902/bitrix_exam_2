<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-54");
?><h3>
[ex2-54] Подсчет количества зарегистрированных пользователе </h3>
<p>
</p>
<p>
	 Создаем агента с параметрами: <br>
</p>
<p>
 <img src="/upload/medialibrary/5d9/5d9d7e15fc42376811047c4387758cb6.png">
</p>
<p>
	 В init.php добавим: <br>
</p>
 <span style="color: #00aeef; font-family: Courier New;">if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agents.php"))</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
&nbsp;&nbsp;&nbsp; require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agents.php");</span><br>
<p>
 <br>
</p>
 В agents.php пишем функцию:
<p>
</p>
<div>
 <span style="color: #00aeef; font-family: Courier New;">function CheckUserCount() </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	{ </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $date = new DateTime(); </span><br>
	 &nbsp;&nbsp;&nbsp; <span style="color: #00ff00;"> </span><span style="color: #00ff00; font-family: Courier New;"> </span><span style="color: #00ff00; font-family: Courier New;"> </span><span style="color: #00ff00; font-family: Courier New;"> //вывод, например: 21.01.2018 10:20:26</span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp; $date = \Bitrix\Main\Type\DateTime::createFromTimestamp($date-&gt;getTimestamp());</span>
</div>
<div>
	&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00ff00; font-family: Courier New;"> //последнее выполнение агента </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp; $lastDate = COption::GetOptionString("main", 'last_date_agent_checkUserCount');</span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; if ($lastDate) { </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arFilter = array('&gt;=DATE_REGISTER' =&gt; $lastDate); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; } else { </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arFilter = array(); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; } </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $rsUsers = CUser::GetList($by = "DATE_REGISTER", $order = "ASC", $arFilter); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $arUsers = array(); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; while ($user = $rsUsers-&gt;Fetch()) { </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arUsers[] = $user; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; } </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; if (! $lastDate) { </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;$lastDate = $arUsers[0]['DATE_REGISTER']; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; } </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $difference = intval(abs( </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; strtotime($lastDate) - strtotime($date-&gt;toString()) </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; )); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $days = round($difference / (3600 * 24)); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $countUsers = count($arUsers); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; $rsAdmins = CUser::GetList($by = "ID", $order = "ASC", array('GROUPS_ID' =&gt; 1)); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; while ($admin = $rsAdmins-&gt;Fetch()) { </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CEvent::Send('COUNT_REGISTERED_USERS', 's1', array( </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 'EMAIL_TO' =&gt; $admin['EMAIL'], </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 'COUNT_USERS' =&gt; $countUsers, </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 'COUNT_DAYS' =&gt; $days, </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ), "Y", "29"); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; } </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; COption::SetOptionString("main", 'last_date_agent_checkUserCount', $date-&gt;toString()); </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; return "CheckUserCount();"; </span><span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	} </span>
</div>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>