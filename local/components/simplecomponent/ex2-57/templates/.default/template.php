<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?

//диапозон цен
$arMinPrise = array();
foreach($arResult["ELEMENTS"] as $item)
{
	$arMinPrise[] = $item['PROPERTY_PRICE_VALUE'];
}
sort($arMinPrise);
$this->SetViewTarget('ex2-57');
echo "<center><br><b>Отображаются товары с дипазоном цен:<br>".array_shift($arMinPrise)." - ".array_pop($arMinPrise)."</b><br><br><br></center>";
$this->EndViewTarget();


//ToDo - мнимальная цена
/*
$arMinPrise = array();
foreach($arResult["ELEMENTS"] as $item)
{
	$arMinPrise[] = $item['PROPERTY_PRICE_VALUE'];
}
sort($arMinPrise);
$this->SetViewTarget('ex2-57');
echo "<center><br><b>Отображаются товары с дипазоном цен:<br>".array_shift($arMinPrise)." - ".array_pop($arMinPrise)."</b><br><br><br></center>";
$this->EndViewTarget();
*/
?>

<br>---<p><b>Каталог:</b></p>
<?
foreach($arResult["SECTIONS"] as $secion)
{
	?>
	<li><?=$secion["NAME"]?></li>
	<ul>
	<? 
	if(isset($arResult["ELEMENTS_SECTIONS"][$secion["ID"]]))
	{
		
		foreach($arResult["ELEMENTS_SECTIONS"][$secion["ID"]] as $pos)
		{
			$elem = $arResult["ELEMENTS"][$pos];
			?><li>
			<?=$elem["NAME"]?> - <?=$elem["PROPERTY_PRICE_VALUE"]?> - <?=$elem["PROPERTY_MATERIAL_VALUE"]?></li><?
		}
	}
	?>
	</ul>
<?
}
?>
</ul>
