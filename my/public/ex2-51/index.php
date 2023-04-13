<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-51");
?><h3>
[ex2-51] Изменение данных в письме </h3>
<p>
</p>
 В /local/php_interface/include/handlers.php размещаем:
<div>
 <span style="color: #00aeef; font-family: Courier New;">&lt;?</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	use \Bitrix\Main\Localization\Loc;</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	Loc::LoadMessages(__FILE__);</span><br>
 <span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	AddEventHandler("main", "OnBeforeEventAdd", array("ExamHandlers", "OnBeforeEventAddHandler"));</span><br>
 <span style="color: #00aeef; font-family: Courier New;"> </span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	class ExamHandlers</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	{</span><br>
 <span style="color: #00aeef; font-family: Courier New;">&nbsp;&nbsp;&nbsp; function OnBeforeEventAddHandler(&amp;$event, &amp;$lid, &amp;$arFields){</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if($event == 'FEEDBACK_FORM'){</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; global $USER;</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; if($USER-&gt;isAuthorized()){</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arFields['AUTHOR'] = Loc::getMessage('AUTHORIZE_USER_1')."[".$USER-&gt;GetID()."] (".$USER-&gt;GetLogin().") ".$USER-&gt;GetFullName().</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Loc::getMessage('FORM_DATA').$arFields['AUTHOR'];</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; else{</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $arFields['AUTHOR'] = Loc::getMessage('NO_AUTHORIZE').$arFields['AUTHOR'];</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CEventLog::Add(array(</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "SEVERITY" =&gt; "SECURITY",</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "AUDIT_TYPE_ID" =&gt; Loc::getMessage('ZAMENA'),</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "MODULE_ID" =&gt; "main",</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "ITEM_ID" =&gt; $event,</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "DESCRIPTION" =&gt; Loc::getMessage('ZAMENA').$arFields['AUTHOR'] ,</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; );</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	&nbsp;&nbsp;&nbsp; }</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	} </span>
</div>
<p>
</p>
<p>
	 В ленговом файле:
</p>
<p>
</p>
<div>
 <span style="font-family: Courier New; color: #00aeef;">$MESS["AUTHORIZE_USER_1"] = "Пользователь авторизован:"; </span><span style="font-family: Courier New; color: #00aeef;"> </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	$MESS["FORM_DATA"] = " данные из формы: "; </span><span style="font-family: Courier New; color: #00aeef;"> </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	$MESS["NO_AUTHORIZE"] = "Пользователь не авторизован, данные из формы: "; </span><span style="font-family: Courier New; color: #00aeef;"> </span><br>
 <span style="font-family: Courier New; color: #00aeef;">
	$MESS["ZAMENA"] = "Замена данных в отсылаемом письме"; </span>
</div>
<h3>Размещенная форма обратной связи для проверки</h3>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"EMAIL_TO" => "test@test.ru",
		"EVENT_MESSAGE_ID" => array(0=>"7",),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(0=>"NAME",),
		"USE_CAPTCHA" => "N"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>