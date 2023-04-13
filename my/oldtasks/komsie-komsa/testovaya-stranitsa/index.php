<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страница");
?><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страничка");
?>


<?

//CheckNewCountNews();

?>


<?
//$APPLICATION->SetPageProperty("my_prop_page", "Это мое свойство страницы - страница /dev/testovaya-stranichka/index.php");
?>
<p>Мое свойство ShowProperty: <?$APPLICATION->ShowProperty("my_prop_page");?>
<p>Мое свойство GetProperty: <?=$APPLICATION->GetProperty("my_prop_page");?>
<?
$APPLICATION->SetPageProperty("my_prop_page", "Это мое свойство страницы - страница /dev/testovaya-stranichka/index.php");
?>

<?
//$APPLICATION->SetPageProperty("my_prop_page", "Это мое свойство страницы - страница /dev/testovaya-stranichka/index.php");
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>