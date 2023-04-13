<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dump($arResult);
//dump($_REQUEST);
?>
---<p><b>Поиск:</b></p>
<form name="filtr" method="get">
 <p><input type="checkbox" name="filtr1" value="OK">Показать товары с ценой больше или равной 1500 и материалом равным «Дерево, ткань»
 <br><input type="checkbox" name="filtr2" value="OK">Показать товары с ценой меньше 1500 и материалом равным «Металл, пластик»
 </p>
 <p>
 <bt><bt><input type="submit" value="Отобрать" name="GO"><input style="margin-left: 10px;" type="submit" value="Сброс" name="Clear">
 </p>
</form>
<br>---<p><b>Каталог:</b></p>
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
			//ToDo, не работает, разберись 
			//$this->AddEditAction($product['ID'], $product['BUTTON'], "Редактировать");
			$elem .= "<li id='".$product["ID"]."'>".$product["NAME"]." - ".$product["PROPERTY_PRICE_VALUE"]." - ".$product["PROPERTY_MATERIAL_VALUE"]."</li>";
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









