<?php 
foreach($arResult['NEWS'] as $vol){
        foreach($vol['PRODUCTS'] as $product){
        	$ss[] = $product['PROPERTY_PRICE_VALUE'];
	}
}
$arResult['MIN_PRICE'] = min($ss);
$arResult['MAX_PRICE'] = max($ss);
$this->__component->SetResultCacheKeys(['MIN_PRICE', 'MAX_PRICE']);
