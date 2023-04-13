<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ex2-93");
?><h3>[ех2-93] Записывать в Журнал событий открытие не существующих страниц сайта</h3>
 В /local/php_interface/include/handlers.php пишем следующее:<br>
 <br>
<div>
 <span style="color: #00aeef; font-family: Courier New;">class ExamHandlers {</span><br>
	&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	function _Check404Error(){</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	if (defined('ERROR_404') &amp;&amp; ERROR_404 == 'Y') {</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	global $APPLICATION;</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	$APPLICATION-&gt;RestartBuffer();</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	include $_SERVER['DOCUMENT_ROOT'] . '/404.php';</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	CEventLog::Add(</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	array(</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"SEVERITY" =&gt; "INFO",</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"AUDIT_TYPE_ID" =&gt; "ERROR_404",</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"MODULE_ID" =&gt; "main",</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	"DESCRIPTION" =&gt; $APPLICATION-&gt;GetCurPage(),</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	)</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	);</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	}</span><br>
	&nbsp;&nbsp; <span style="color: #00aeef; font-family: Courier New;">
	}</span><br>
 <span style="color: #00aeef; font-family: Courier New;">
	}</span>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>