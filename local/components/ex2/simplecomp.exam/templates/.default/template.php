<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(isset($arResult['FILTER_LINK'])) echo GetMessage("FILTER").$arResult['FILTER_LINK']."</br>";

$this->AddEditAction('iblock_'.$arResult['IBLOCK_ID'], $arResult['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_ADD"));

echo GetMessage('METCA_TIME').time()."</br>";

echo '---<br/><br/>';
echo '<b>'.GetMessage('CATALOG').'</b><br/>';
echo '<ul id="'.$this->GetEditAreaId('iblock_'.$arResult['IBLOCK_ID']).'">';
foreach($arResult['ITEMS'] as $key => $item){
   
    ?>
    <li><b><?= $item['NAME']?></b>
    <ul>
    
    <?
    foreach($item['PRODUCTS'] as $prodId){
        $arProduct = $arResult['ALL_PRODUCTS'][$prodId];
        $ermit_id = $key.'_'.$prodId;
        $this->AddEditAction($ermit_id, $arProduct['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($ermit_id, $arProduct['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        // echo '<li>'.$arProduct['NAME'].' - '.$arProduct['PRICE'].' - '.$arProduct['MATERIAL'].' <a href="'.$arProduct['LINK'].'">'.GetMessage('PODROB').'</a> '.'</li>';
        echo '<li  id="'.$this->GetEditAreaId($ermit_id).'">'.$arProduct['NAME'].' - '.$arProduct['PRICE'].' - '.$arProduct['MATERIAL'].' - '.$arProduct['ARTNUMBER'].' - ('.$arProduct['LINK'].')'.'</li>';
    }
    ?>
    </ul>
    </li>
<?}?>
</ul>

<?= $arResult["NAV_STRING"]; ?>

