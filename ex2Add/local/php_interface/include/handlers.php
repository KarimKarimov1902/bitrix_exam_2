<?
use \Bitrix\Main\Localization\Loc;
Loc::LoadMessages(__FILE__);

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ExamHandlers", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("ExamHandlers", "OnBeforeIBlockElementAddHandler"));
AddEventHandler("main", "OnBeforeEventAdd", array("ExamHandlers", "OnBeforeEventAddHandler"));
//AddEventHandler('main', 'OnEpilog', array("ExamHandlers", "_Check404Error"));
AddEventHandler("main", "OnBuildGlobalMenu", array("ExamHandlers", "OnBuildGlobalMenuHandler"));
AddEventHandler("main", "OnBeforeProlog", array("ExamHandlers", "MyOnBeforePrologHandler"), 50);
AddEventHandler("search", "BeforeIndex", array("ExamHandlers", "myBeforeIndexHandler"));

class ExamHandlers
{
    // ех2-92
    function myBeforeIndexHandler($arFields)
    {
       if(!CModule::IncludeModule("iblock")) // подключаем модуль
          return $arFields;

       if($arFields["MODULE_ID"] == "iblock")
       {
            $arFields["TITLE"] = substr($arFields["BODY"], 0, 50)."...";
            
       }
       return $arFields; // Обязательно!!!
    }

    // ех2-75
    function OnBeforeIBlockElementAddHandler(&$arFields)
    {        
        if($arFields["IBLOCK_ID"] == NEWS_ID)
        {
            if(strpos($arFields["PREVIEW_TEXT"], "калейдоскоп" ) !== false)
            {
                $arFields["PREVIEW_TEXT"] = str_replace("калейдоскоп", "[...]", $arFields["PREVIEW_TEXT"]);

                CEventLog::Add(array(
                    "SEVERITY" => "SECURITY",
                    //"AUDIT_TYPE_ID" => Loc::getMessage('ZAMENA'),
                    "MODULE_ID" => "main",
                    //"ITEM_ID" => $event,
                    "DESCRIPTION" => "Замена слова калейдоскоп на [...], в новости с ID = ".$arFields["ID"]
                    )
                );

                global $APPLICATION;
                $APPLICATION->throwException("Мы не используем слово калейдоскоп в анонсах новостей!");
                return false;
            }
        }
    }

    // ex2-94
    function MyOnBeforePrologHandler(){
        global $APPLICATION;
        $cur_page = $APPLICATION->GetCurDir();
        if(\Bitrix\Main\Loader::includeModule('iblock')){
            $arFilter = array('IBLOCK_ID' => IBLOCK_META, 'NAME' => $cur_page);
            $arSelect = array('IBLOCK_ID', 'ID', 'PROPERTY_TITLE', 'PROPERTY_DESC');
            $r = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if($res = $r->Fetch()){
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/local/filename.txt', date('Y-m-d h:i:s').'--'.var_export($res, 1)."\n", FILE_APPEND);
                $APPLICATION->SetPageProperty('title', $res['PROPERTY_TITLE_VALUE']);
                $APPLICATION->SetPageProperty('description', $res['PROPERTY_DESC_VALUE']);
            }
        }
    }    

    // ex2-95
    function OnBuildGlobalMenuHandler(&$aGlobalMenu, &$aModuleMenu){
        global $USER;
        $userGroups = \CUser::GetUserGroupList($USER->GetId());
        $contentGroupID = \CGroup::GetList ($by = "c_sort", $order = "asc", array("STRING_ID" => 'content_editor'))->Fetch()['ID'];
        while ($group = $userGroups->Fetch()) {
            if ($group['GROUP_ID'] == 1) {
                $isAdmin = true;
            };
            if ($group['GROUP_ID'] == $contentGroupID) {
                $isManager = true;
            }
        }
        if ($isAdmin != true && $isManager == true) {
            foreach ($aModuleMenu as $key => $item) {
                if ($item['items_id'] == 'menu_iblock_/news') {
                    $aModuleMenu = [$item];
                    foreach ($item['items'] as $childItem) {
                        if ($childItem['items_id'] == 'menu_iblock_/news/1') {
                            $aModuleMenu[0]['items'] = [$childItem];
                            break;
                        }
                    }
                    break;
                }
            }
            $aGlobalMenu = ['global_menu_content' => $aGlobalMenu['global_menu_content']];
        }
    }

    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        // ех2-75
        if($arFields["IBLOCK_ID"] == NEWS_ID)
        {
            if(strpos($arFields["PREVIEW_TEXT"], "калейдоскоп" ) !== false)
            {   
                $arFields["PREVIEW_TEXT"] = str_replace("калейдоскоп", "[...]", $arFields["PREVIEW_TEXT"]);
                
                CEventLog::Add(array(
                    "SEVERITY" => "SECURITY",
                    //"AUDIT_TYPE_ID" => Loc::getMessage('ZAMENA'),
                    "MODULE_ID" => "main",
                    //"ITEM_ID" => $event,
                    "DESCRIPTION" => "Замена слова калейдоскоп на [...], в новости с ID = ".$arFields["ID"]
                    )
                );

                global $APPLICATION;
                $APPLICATION->throwException("Мы не используем слово калейдоскоп в анонсах новостей!");
                return false;
            }
        }
        
        // ex2-50
    	if(($arFields["ACTIVE"] == "N") && ($arFields["IBLOCK_ID"] == CATALOG_ID)){
            $r = CIBlockElement::GetByID($arFields['ID']);
            if($res = $r -> Fetch()){
                $show_counter = $res['SHOW_COUNTER'];
            }
            if($show_counter > SHOW_COUNTER_VALUE){
                global $APPLICATION;
                $APPLICATION->throwException(Loc::getMessage('SHOW_COUNTER_ERROR_1').$show_counter.Loc::getMessage('SHOW_COUNTER_ERROR_2'));
                return false;
            }
    	}
    }

    // ex2-51
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields){
        if($event == 'FEEDBACK_FORM'){
            global $USER;
            if($USER->isAuthorized()){
                $arFields['AUTHOR'] = Loc::getMessage('AUTHORIZE_USER_1')."[".$USER->GetID()."] (".$USER->GetLogin().") ".$USER->GetFullName().
                Loc::getMessage('FORM_DATA').$arFields['AUTHOR'];
            }
            else{
                $arFields['AUTHOR'] = Loc::getMessage('NO_AUTHORIZE').$arFields['AUTHOR'];
            }
            CEventLog::Add(array(
                "SEVERITY" => "SECURITY",
                "AUDIT_TYPE_ID" => Loc::getMessage('ZAMENA'),
                "MODULE_ID" => "main",
                "ITEM_ID" => $event,
                "DESCRIPTION" => Loc::getMessage('ZAMENA').$arFields['AUTHOR'] ,
                )
            );
        }
    }
    
    // ex2-94
	function _Check404Error(){
		if (defined('ERROR_404') && ERROR_404 == 'Y') {

		global $APPLICATION;
		$APPLICATION->RestartBuffer();
		include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
		include $_SERVER['DOCUMENT_ROOT'] . '/404.php';
		include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';

		CEventLog::Add(
			array(
				"SEVERITY" 		=> "INFO",
				"AUDIT_TYPE_ID" => "ERROR_404",
				"MODULE_ID" 	=> "main",
				"DESCRIPTION" 	=> $APPLICATION->GetCurPage(),
			)
		);
		}
	}


}