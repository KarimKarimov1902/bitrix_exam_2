<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<? foreach($arResult["USERS"] as $key => $user): ?>
<ul>
    <li>[<?=$key?>] - <?=$user['LOGIN']?>
        <ul>
            <? foreach($user["ELEMENTS"] as $elements): ?>
            <li>
                <? echo '- '. $elements['NAME']. "<br>"?>
              <?  endforeach;?>
            </li>
        </ul>
    </li>
</ul>
<? endforeach;?>
