<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
//dump($_REQUEST);
?>

<form name="filtr" method="get">
 <p><input type="checkbox" name="filtr1" value="OK">Показать товары с ценой больше 10000 и материалом равным «Кожа, металл, ткань»
 <bt><input type="checkbox" name="filtr2" value="OK">Показать товары с ценой меньше 9000 и материалов равным «Кожа, ткань»
 </p>
 <p>
 <bt><bt><input type="submit" value="Отобрать" name="GO">
 </p>
</form>
<br><br><br>

<?
$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
$TOP_DEPTH = 3;
$CURRENT_DEPTH = $TOP_DEPTH;

foreach($arResult["SECTIONS"] as $arSection)
{
	if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
	{
		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul>";
	}
	elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
	{
		echo "</li>";
	}
	else
	{
		while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
		{
			echo "</li>";
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
			$CURRENT_DEPTH--;
		}
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
	}

	$link = '<span><b>'.$arSection["NAME"].'</b></span>';
	$elem = "";
	
	if(isset($arSection["ELEMENTS"]))
	{
		$elem = "<ul>";
		foreach($arSection["ELEMENTS"] as $product)
		{
			$elem .= "<li>".$product["NAME"]." - ".$product["PROPERTY_PRICE_VALUE"]." - ".$product["PROPERTY_MATERIAL_VALUE"]."</li>";
		}
		$elem .= "</ul>";
	}
	
	echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
	?><li><?=$link?><?=$elem?><?

	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
}

while($CURRENT_DEPTH > $TOP_DEPTH)
{
	echo "</li>";
	echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
	$CURRENT_DEPTH--;
}
?>









