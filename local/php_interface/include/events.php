<?
    const PRODUCT_IBLOCK = 2;
    const MANAGER_GROUP = 5;
    const METATEG_IBLOCK = 6;

    /* файл /bitrix/php_interface/dbconn.php

    определим константу LOG_FILENAME, в которой зададим путь к лог-файлу
    define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
    // Сохраним в лог сообщение
    AddMessage2Log("Произвольный текст сообщения", "my_module_id");
    */
    //[ex2-50] Проверка при деактивации товара 
    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate",  "OnBeforeIBlockElementUpdateHandler");

    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {   
        if($arFields["IBLOCK_ID"] == PRODUCT_IBLOCK &&  $arFields["ACTIVE"] == 'N')
        {
            $res = CIBlockElement::GetList(
                false, 
                Array("IBLOCK_ID"=>PRODUCT_IBLOCK, "ID"=>$arFields['ID'],">SHOW_COUNTER"=>2), 
                false, 
                Array("nTopCount"=>1), 
                Array("ID", "SHOW_COUNTER")
            );
           
            if($fields = $res->Fetch())
            {
                global $APPLICATION;
                $APPLICATION->throwException(str_replace("#COUNT#", $fields["SHOW_COUNTER"],  GetMessage("ERROR_DEACT")));
                return false;
            }
    
        }
    }

    //[ex2-93] Записывать в Журнал событий открытие не существующих страниц сайта
    AddEventHandler("main", "OnEpilog",  "OnEpilogHandler",1);

    function OnEpilogHandler()
    {
        if(defined("ERROR_404") && ERROR_404 == 'Y'){

            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "ERROR_404",
                "MODULE_ID" => "main",
                "DESCRIPTION" => $_SERVER['REQUEST_URL'],
             ));

            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            include $_SERVER["DOCUMENT_ROOT"]. SITE_TEMPLATE_PATH ."/header.php";
            include $_SERVER["DOCUMENT_ROOT"]."/404.php";
            include $_SERVER["DOCUMENT_ROOT"]. SITE_TEMPLATE_PATH ."/footer.php";
        }

    }

    //[ex2-51] Изменение данных в письме
    AddEventHandler("main", "OnBeforeEventAdd",  "OnBeforeEventAddHandler");

    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
       if($event == 'FEEDBACK_FORM'){
            global $USER;
            if($user_id = $USER->getId()){
                $rsUser = CUser::GetByID($user_id);
                $arUser = $rsUser->Fetch();

                $arFields['AUTHOR'] = str_replace(
                    ['#ID#','#LOGIN#','#NAME#'],
                    [$user_id, $arUser['LOGIN'], $arUser['LAST_NAME'].' '.$arUser['NAME'].' '.$arUser['SECOND_NAME']],
                    GetMessage('AUTH') 
                ).$arFields['AUTHOR'];
            } else {
                $arFields['AUTHOR'] = GetMessage('NOT_AUTH').$arFields['AUTHOR'];
            }

            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "FEEDBACK_FORM",
                "MODULE_ID" => "main",
                "DESCRIPTION" => GetMessage('DESC').$arFields['AUTHOR'],
             ));
       }
    }

    //[ex2-95] Упростить меню в адмистративном разделе для контент-менеджера
    AddEventHandler("main", "OnBuildGlobalMenu", "MyOnBuildGlobalMenu");

    function MyOnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER;
        if(in_array(MANAGER_GROUP,$USER->GetUserGroupArray())){
            foreach($aGlobalMenu as $key=>$menu){
                if($key != "global_menu_content"){
                    unset($aGlobalMenu[$key]);
                }
            }

            foreach($aModuleMenu as $key=>$menu){
                if($menu['items_id'] != 'menu_iblock_/news'){
                    unset($aModuleMenu[$key]);
                }
            }
        }
    }

    // [ex2-94] Супер инструмент SEO специалиста 
    AddEventHandler("main", "OnPageStart","OnPageStartHandler");

    function OnPageStartHandler(){

        if(!CModule::IncludeModule("iblock")) return true;

        global $APPLICATION;

        $currentPage = $APPLICATION->GetCurPage();
        if(strpos($currentPage, '/bitrix/') === 0) return true;
        if(substr($currentPage, -10) == '/index.php') return $currentPage = substr($currentPage, -9);

        $res = CIBlockElement::GetList(
            false, 
            Array("IBLOCK_ID"=>METATEG_IBLOCK, "%NAME"=>$currentPage, "ACTIVE"=>'Y'), 
            false, 
            false, 
            Array("ID", "NAME","PROPERTY_TITLE","PROPERTY_DESCRIPTION")
        );
        
        while($fields = $res->Fetch()){
            if(trim($fields['NAME']) == $currentPage){
                $APPLICATION->SetPageProperty('title', $fields['PROPERTY_TITLE_VALUE']);
                $APPLICATION->SetPageProperty('description', $fields['PROPERTY_DESCRIPTION_VALUE']);
                break;
            }
        }
    }

?>