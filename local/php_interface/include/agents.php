<?

const MAIL_TEMPLATE = 32;
const GROUP_ADMIN = 1;

function CheckUserCount()
{
    $last_user_id = COption::GetOptionInt("main", "last_user_id", 0);

    $rsUsers = CUser::GetList(
        ($by="id"), 
        ($order="desc"), 
        array('>ID'=>$last_user_id),
        array("FIELDS"=>array('ID'))
    );

    if($count_user = $rsUsers->SelectedRowsCount()) {
        $arUser = $rsUsers->Fetch();
        $new_last_id =$arUser['ID'];

        if($time_check_user = COption::GetOptionInt("main", "time_check_user", 0)){
            $days = round((time()-$time_check_user)/86400);
            if(!$days){
                $days = 1;
            }
        }
        else{
            $days = 1;
        }

        if($days == 1){
            $days .= GetMessage('DAY_1');
        } else if($days > 4 ){
            $days .= GetMessage('DAY_5');
        }
        else{
            $days .= GetMessage('DAY_2');
        }

        $arFields = array("COUNT"=>$count_user, "DAYS"=>$days);

        $rsUsers = CUser::GetList(
            ($by="id"), 
            ($order="desc"), 
            array('GROUPS_ID'=>GROUP_ADMIN),
            array("FIELDS"=>array('ID','EMAIL'))
        );

        while($arUser = $rsUsers->Fetch()){
            $arFields['EMAIL'] = $arUser['EMAIL'];
            CEvent::Send("NEW_REGISTRATION", "s1", $arFields, "N", MAIL_TEMPLATE);
        }
        COption::setOptionInt("main","last_user_id", $new_last_id);
    }

    COption::GetOptionInt("main","time_check_user", time());

    return "CheckUserCount();";
}

?>