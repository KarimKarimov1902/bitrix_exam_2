<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Application;
use Bitrix\Main\HttpApplication;
$request = Application::getInstance()->getContext()->getRequest();
$server = Application::getInstance()->getContext()->getServer();
$cur_docroot = $server->getDocumentRoot();
$cur_dir = $request->getRequestedPageDirectory();
$cur_uri =$request->getRequestUri();

if($arParams["SEF_MODE"] == N)
{
?>
<br>Если НЕ ЧПУ режим<br>
- Главная: <a href="http://<?echo $server->getServerName()?><?echo $cur_dir?>/">http://<?echo $server->getServerName()?><?echo $cur_dir?>/</a><br>
- Раздел c резюме: <a href="http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["SECTION_ID"]?>=1">http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["SECTION_ID"]?>=1</a><br>
- Резюме в разеделе: <a href="http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["SECTION_ID"]?>=1&<?echo $arResult["ALIASES"]["RESUME_ID"]?>=2">http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["SECTION_ID"]?>=1<?echo $arResult["ALIASES"]["RESUME_ID"]?>=2</a><br> 
- Пользователь: <a href="http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["USER_ID"]?>=3">">http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["USER_ID"]?>=3</a><br>
- Резюме пользователя: <a href="http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["USER_ID"]?>=3&<?echo $arResult["ALIASES"]["RESUME_ID"]?>=2">http://<?echo $server->getServerName()?><?echo $cur_dir?>/?<?echo $arResult["ALIASES"]["USER_ID"]?>=3&<?echo $arResult["ALIASES"]["RESUME_ID"]?>=2</a><br>
<?
}
else
{
?>
<br><br>Если ЧПУ<br>
- Главная: <a href="http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>">http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?></a><br>
- Раздел c резюме: <a href="http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>1/">http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>1/</a><br>
- Резюме в разеделе: <a href="http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>1/2/">http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>1/2/</a><br>
- Пользователь: <a href="http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>3user.php">http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>3user.php</a><br>  
- Резюме пользователя: <a href="http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>3userresume.php?<?echo $arResult["ALIASES"]["USER_ID"]?>=4">http://<?echo $server->getServerName()?><?echo $arParams["SEF_FOLDER"]?>3userresume.php?RES_ID=4</a><br>
<br><br>
<?
}
?>
<?
dump($arParams);
dump($arResult);
?>	
