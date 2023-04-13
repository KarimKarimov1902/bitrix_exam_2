<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,	Bitrix\Iblock;

if (!isset($arParams["CACHE_TIME"]))
{
	$arParams["CACHE_TIME"] = 36000000;
}

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

global $USER;
$arResult["COUNT"] = 0;
if($USER->IsAuthorized()) {
    \CModule::IncludeModule("iblock");
    $currentUserId = $USER->GetId();
    // Получаем тип текущего пользователя
    $currentUserType = \CUser::GetList(
        ($by="id"),
        ($order="asc"),
        array("ID" => $USER->GetId()),
        array("SELECT" => array($arParams["FIELD_AUTHOR_CODE"]))
    )->Fetch()[$arParams["FIELD_AUTHOR_CODE"]];
    if($this->startResultCache(false, $currentUserType) && !empty($currentUserType)) {
        if (!Loader::includeModule("iblock")) 
        {
            $this->abortResultCache();
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
            return;
        }

        // Получаем всех пользователей такого же типа, как у текущего, кроме текущего
        $users = \CUser::GetList(
            ($by="id"),
            ($order="desc"),
            array(
                $arParams["FIELD_AUTHOR_CODE"] => $currentUserType,
                "!ID" => $currentUserId      
            ),
            array("SELECT" => array("LOGIN", "ID"))
        );
        while ($user = $users->Fetch()) {
            $userList[$user["ID"]] = array("LOGIN" => $user["LOGIN"]);
            $userIds[] = $user["ID"];
        }
        if(!empty($userIds)) {
            // Получаем новости, принадлежащие пользователем такого же типа, как у текущего, кроме текущего пользователя
            $news = \CIBlockElement::GetList(
                array(),
                array(
                    "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
                    "!PROPERTY_".$arParams["PROPERTY_AUTHOR_CODE"] => $currentUserId,
                    "PROPERTY_".$arParams["PROPERTY_AUTHOR_CODE"] => $userIds
                ),
                false, false,
                array("NAME", "ACTIVE_FROM", "ID", "IBLOCK_ID", "PROPERTY_".$arParams["PROPERTY_AUTHOR_CODE"])
            );
            // Составляем массив из уникальных новостей
            while ($newsItem = $news->Fetch()) {
                if(empty($newsList[$newsItem["ID"]])) {
                    $newsList[$newsItem["ID"]] = $newsItem;
                }
                $newsList[$newsItem["ID"]]["AUTHORS"][] = $newsItem["PROPERTY_".$arParams["PROPERTY_AUTHOR_CODE"]."_VALUE"];
            };
            $newsCount = count($newsList);
            // Группируем новости по пользователям
            foreach ($newsList as $key => $value) {
                foreach ($value["AUTHORS"] as $authorId) {
                    $userList[$authorId]["NEWS"][] = $value;
                }
            }
            $arResult["AUTHORS"] = $userList;
            $arResult["COUNT"] = $newsCount;
            $this->SetResultCacheKeys(array("COUNT"));
            $this->IncludeComponentTemplate();
        }
    }else 
    {
        $this->abortResultCache();
    }
}
$APPLICATION->SetTitle(GetMessage("COUNT_NEWS").$arResult["COUNT"]);
