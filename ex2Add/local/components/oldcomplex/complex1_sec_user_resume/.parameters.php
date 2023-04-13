<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



$arComponentParameters = array(
	
	"PARAMETERS" => array(
			
		"VARIABLE_ALIASES" => array(
			"USER_ID" => array(
				"NAME" => "ИД Пользователя",
			),
			"SECTION_ID" => array(
				"NAME" => "ИД раздела",
			),
			"RESUME_ID" => array(
					"NAME" => "ИД Резюме",
			),
		),
			
		"SEF_MODE" => array (
				"main" => array (
						"NAME" => "главная списка резюме",
						"DEFAULT" => "",
						"VARIABLES" => array() 
				),
				"user" => array (
						"NAME" => "просмотр профиля юзера",
						"DEFAULT" => "#USER_ID#user.php",
						"VARIABLES" => array("USER_ID") 
				),
				"section" => array (
						"NAME" => "Раздел вакансий",
						"DEFAULT" => "#SECTION_ID#/",
						"VARIABLES" => array("SECTION_ID")
				),
				"resume" => array (
						"NAME" => "Просмотр резюме из списка",
						"DEFAULT" => "#SECTION_ID#/#RESUME_ID#/",
						"VARIABLES" => array("SECTION_ID", "RESUME_ID") 
				), 
				"userresume" => array (
						"NAME" => "просмотр резюме юзера",
						"DEFAULT" => "#USER_ID#userresume.php?RES_ID=#RES_ID#",
						//"VARIABLES" => array (),
						"VARIABLES" => array("USER_ID", "RES_ID")
						//"VARIABLES" => array (
								//"ID",
						//
				),		
		),				
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);


?>
