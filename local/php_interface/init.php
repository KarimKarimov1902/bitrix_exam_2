<?
const SEVICE_IBLOCK = 3;

require_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/events.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/include/agents.php');


if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agents.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agents.php");

?>