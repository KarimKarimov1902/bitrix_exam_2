<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<ul>
    <? foreach($arResult['ITEMS'] as $newId=>$new):
        $sectionNames = "";
        foreach($new['SECTIONS'] as $sectionID){
            $sectionNames .= ", ".$arResult['SECTIONS'][$sectionID]['NAME'];
        }
    ?>

    <li><b><?= $new['NAME']?></b> <?= $new['ACTIVE_FROM']?> - (<?= substr($sectionNames, 2);  ?>)</li>
    <ul>
        <? foreach($new['PRODUCTS'] as $productID):?>
            <li>
                <?= $arResult['PRODUCTS'][$productID]['NAME']. " - ".
                    $arResult['PRODUCTS'][$productID]['PRICE']. " - ".
                    $arResult['PRODUCTS'][$productID]['MATERIAL']. " - ".
                    $arResult['PRODUCTS'][$productID]['ARTNUMBER']; ?>
            </li>
        <? endforeach;?>
    </ul>
    <? endforeach;?>
</ul>
