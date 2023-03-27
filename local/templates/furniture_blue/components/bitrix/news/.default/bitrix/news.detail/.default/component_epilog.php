<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
// Сбор жалоб на новости, на AJAX
const IBLOCK_ZALOB = 8;

// link rel="canonical" для детальной новости
if(isset($arResult['CANONICAL_LINK'])){
    $APPLICATION->SetPageProperty('canonical', $arResult['CANONICAL_LINK']);
}
// Сбор жалоб на новости, на AJAX
if($_REQUEST['zal'] ==1 && ($newId = (int)$_REQUEST['id'])){ 
    $name = session_id().'_'.$newId;

    $res = CIBlockElement::GetList(
        false,
        array('IBLOCK'=>IBLOCK_ZALOB, 'ACTIVE' => 'Y', 'NAME' => $name),
        false,
        array('nTopCount' => 1),
        array('ID'),
    );

    if($res->SelectedRowsCount()){
        $result = GetMessage('UZE');
    } else {
        if($userId =$USER->GetId()){
            $rsUser = CUser::GetByID($userId);
            $arUser = $rsUser->Fetch();
            $propUser = $arUser['ID']. ', '. $arUser['LOGIN']. ', '. $arUser['LAST_NAME']. ', '. $arUser['NAME']. ', '. $arUser['SECOND_NAME'];
        }
        else {
            $propUser = GetMessage('NOT_AUTH');
        }

        $el = new CIBlockElement;
        if($newZalob = $el->Add(array(
                'IBLOCK_ID'=>IBLOCK_ZALOB,
                'NAME'=>$name,
                'ACTIVE_FROM' => date('d.m.Y H:i:s', time()),
                'PROPERTY_VALUES' => array(
                    'USER' => $propUser,
                    'NEW' => $newId,
                )
            )
        )){
            $result = GetMessage('FINISH').$newZalob;
        }
        else{
            $result = GetMessage('ERROR');
        }
    }

    if(isset($_REQUEST['ajax'])){
        $APPLICATION->RestartBuffer();
        die($result);
    }
    else {
        ?>
        <script>
            $(function(){
                $('#result_zalob').html('<?= $result;?>').show();
            });
        </script>
        <?
    }
}
?>