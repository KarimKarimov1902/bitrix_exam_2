<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(isset($_REQUEST['ajax_action']) && ($_REQUEST['ajax_action']== "addcallprice"))
{
	$GLOBALS['APPLICATION']->RestartBuffer();
	echo CUtil::PhpToJSObject(array(
			'RESULT' => 'OK',
			'ajax_action' => $_REQUEST['ajax_action'],
			'elementid' => $_REQUEST['elementid'],
	));
	die();
}
?>