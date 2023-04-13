<?
define("SM_SAFE_MODE", true); 
define("NOT_CHECK_PERMISSIONS",true);
define("NO_AGENT_CHECK", true);
define("NO_AGENT_STATISTIC", true);
define("STOP_STATISTICS", true);
include($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
//CModule::IncludeModule('main');
//COption::SetOptionString("main", "update_autocheck",0);
global $USER;
$USER->Authorize(1);
LocalRedirect('/bitrix/admin/');
?>