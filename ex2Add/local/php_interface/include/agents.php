<?
function CheckUserCount(){
    $date = new DateTime();
    $date = \Bitrix\Main\Type\DateTime::createFromTimestamp($date->getTimestamp()); //вывод, например: 21.01.2018 10:20:26
    $lastDate = COption::GetOptionString("main", "last_date_agent_checkUserCount");//последнее выполнение агента
    if ($lastDate) {
        $arFilter = array(">=DATE_REGISTER" => $lastDate);
    }else{
        $arFilter = array();
    }
    $rsUsers = CUser::GetList($by = "DATE_REGISTER", $order = "ASC", $arFilter);
    $arUsers = array();
    while ($user = $rsUsers->Fetch()) {
        $arUsers[] = $user;
    }
    if (!$lastDate) {
        $lastDate = $arUsers[0]["DATE_REGISTER"];
    }
    $difference = intval(abs(strtotime($lastDate) - strtotime($date->toString())));
    $days = round($difference / (3600 * 24));
    $countUsers = count($arUsers);
    $rsAdmins = CUser::GetList($by = "ID", $order = "ASC", array("GROUPS_ID" => 1));
    while ($admin = $rsAdmins->Fetch()) {
        CEvent::Send(
            "COUNT_REGISTERED_USERS", 
            "s1", 
            array(
                "EMAIL_TO" => $admin["EMAIL"],
                "COUNT_USERS" => $countUsers,
                "COUNT_DAYS" => $days,
            ), 
            "Y", 
            "29"
        );
    }
    COption::SetOptionString("main", "last_date_agent_checkUserCount", $date->toString());

    return "CheckUserCount();";
}

// ех2-86
function ExamCheckCount(){
    $rsAdmins = CUser::GetList($by = "ID", $order = "ASC", array("ID" => 1))->fetch(); 
    CEvent::Send(
        "COUNT_REGISTERED_USERS",
        "s1",
        array(
            "EMAIL_TO" => $rsAdmins["EMAIL"],
            "MESSAGE" => "На сайте зарегистрировано ".CUser::GetCount()." пользователей",
        ),
        "Y",
        "29"
    );

    return "ExamCheckCount();";
}

function dump($var)
{
    global $USER;
    if($USER->isAdmin())
    {
        echo("---<bt><pre>");
        var_dump($var);
        echo("</pre>---<br><br><br>");
    }
}
