<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["isFormErrors"] == "Y"){
    echo $arResult["FORM_ERRORS_TEXT"];
}

$i = 0;
foreach ($arResult["QUESTIONS"] as $key => $arQuestion) {
    $arResult['ID_QUESTIONS'][$i++] = $key; // в этот массив получаем символьные идентификаторы вопросов
}

?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y"):?>

    <?if ($arResult["isFormImage"] == "Y"):?>
        <a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
        <?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
    <?endif; //endif ?>

    <div class="contact-form">
        <div class="contact-form__head">
            <div class="contact-form__head-title">
                <?if($arResult["isFormTitle"]):?>
                    <?=$arResult["FORM_TITLE"]?>
                <?endif;?>
            </div>
            <div class="contact-form__head-text">
                <?if($arResult["isFormDescription"]):?>
                    <?=$arResult["FORM_DESCRIPTION"]?>
                <?endif;?>
            </div>
        </div>

        <?=str_replace('<form', '<form class="contact-form__form"', $arResult["FORM_HEADER"])?>
            <div class="contact-form__form-inputs">

                <!-- 1 -->
                <? preg_match('#(?<=name=")(.+?)(?=")#', $arResult['QUESTIONS'][$arResult['ID_QUESTIONS'][0]]["HTML_CODE"], $matches); 
                    $name = $matches[1] ?>
                <div class="input contact-form__input">
                    <label class="input__label" for="<?=$name?>">
                    <div class="input__label-text">
                        <?= $arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][0]]["CAPTION"] ?>
                        <?if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][0]]["REQUIRED"] == "Y") echo $arResult["REQUIRED_SIGN"];?>
                    </div>

                    <input class="input__input" type="<?= $arResult["arQuestions"][$arResult['ID_QUESTIONS'][0]]["TITLE_TYPE"] ?>"
                       id="<?= $name ?>"
                       name="<?= $name ?>"
                       value=""
                    <? if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][0]]["REQUIRED"] == "Y"): ?><?= 'required="required"' ?><? endif; ?>>

                    <div class="input__notification">
                        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($arResult['ID_QUESTIONS'][0], $arResult['FORM_ERRORS'])):?>
                            <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$arResult['ID_QUESTIONS'][0]])?>
                        <?endif;?>
                    </div>
                    </label>
                </div>

                <!-- 2 -->
                <? preg_match('#(?<=name=")(.+?)(?=")#', $arResult['QUESTIONS'][$arResult['ID_QUESTIONS'][1]]["HTML_CODE"], $matches); 
                    $name = $matches[1] ?>
                <div class="input contact-form__input">
                    <label class="input__label" for="<?=$name?>">
                    <div class="input__label-text">
                        <?= $arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][1]]["CAPTION"] ?>
                        <?if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][1]]["REQUIRED"] == "Y") echo $arResult["REQUIRED_SIGN"];?>
                    </div>

                    <input class="input__input" type="<?= $arResult["arQuestions"][$arResult['ID_QUESTIONS'][1]]["TITLE_TYPE"] ?>"
                       id="<?= $name ?>"
                       name="<?= $name ?>"
                       value=""
                    <? if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][1]]["REQUIRED"] == "Y"): ?><?= 'required="required"' ?><? endif; ?>>

                    <div class="input__notification">
                        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($arResult['ID_QUESTIONS'][1], $arResult['FORM_ERRORS'])):?>
                            <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$arResult['ID_QUESTIONS'][1]])?>
                        <?endif;?>
                    </div>
                    </label>
                </div>
            

                <!-- 3 -->
                <? preg_match('#(?<=name=")(.+?)(?=")#', $arResult['QUESTIONS'][$arResult['ID_QUESTIONS'][2]]["HTML_CODE"], $matches); 
                    $name = $matches[1] ?>
                <div class="input contact-form__input">
                    <label class="input__label" for="<?=$name?>">
                    <div class="input__label-text">
                        <?= $arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][2]]["CAPTION"] ?>
                        <?if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][2]]["REQUIRED"] == "Y") echo $arResult["REQUIRED_SIGN"];?>
                    </div>

                    <input class="input__input" type="<?= $arResult["arQuestions"][$arResult['ID_QUESTIONS'][2]]["TITLE_TYPE"] ?>"
                       id="<?= $name ?>"
                       name="<?= $name ?>"
                       value=""
                    <? if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][2]]["REQUIRED"] == "Y"): ?><?= 'required="required"' ?><? endif; ?>>

                    <div class="input__notification">
                        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($arResult['ID_QUESTIONS'][2], $arResult['FORM_ERRORS'])):?>
                            <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$arResult['ID_QUESTIONS'][2]])?>
                        <?endif;?>
                    </div>
                    </label>
                </div>

                <!-- 4 -->
                <? preg_match('#(?<=name=")(.+?)(?=")#', $arResult['QUESTIONS'][$arResult['ID_QUESTIONS'][3]]["HTML_CODE"], $matches);
                    $name = $matches[1] ?>
                <div class="input contact-form__input">
                    <label class="input__label" for="<?=$name?>">
                    <div class="input__label-text">
                        <?= $arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][3]]["CAPTION"] ?>
                        <?if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][3]]["REQUIRED"] == "Y") echo $arResult["REQUIRED_SIGN"];?>
                    </div>

                    <input class="input__input" type="<?= $arResult["arQuestions"][$arResult['ID_QUESTIONS'][3]]["TITLE_TYPE"] ?>"
                       id="<?= $name ?>"
                       name="<?= $name ?>"
                       value=""
                    <? if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][3]]["REQUIRED"] == "Y"): ?><?= 'required="required"' ?><? endif; ?>>

                    <div class="input__notification">
                        <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($arResult['ID_QUESTIONS'][3], $arResult['FORM_ERRORS'])):?>
                            <?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$arResult['ID_QUESTIONS'][3]])?>
                        <?endif;?>
                    </div>
                    </label>
                </div>
            </div>

            <!-- textarea message -->
            <div class="contact-form__form-message">
                <? preg_match('#(?<=name=")(.+?)(?=")#', $arResult['QUESTIONS'][$arResult['ID_QUESTIONS'][4]]["HTML_CODE"], $matches); 
                    $name = $matches[1] ?>
                <div class="input"><label class="input__label" for="<?= $name ?>">
                        <div class="input__label-text"><?= $arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][4]]["CAPTION"] ?>
                            <? if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][4]]["REQUIRED"] == "Y"): ?><?= $arResult["REQUIRED_SIGN"]; ?><? endif; ?></div>
                        <textarea class="input__input" type="<?= $arResult["arQuestions"][$arResult['ID_QUESTIONS'][4]]["TITLE_TYPE"] ?>"
                                  id="<?= $name ?>"
                                  name="<?= $name ?>"
                            <? if ($arResult["QUESTIONS"][$arResult['ID_QUESTIONS'][4]]["REQUIRED"] == "Y"): ?><?= 'required="required"' ?><? endif; ?>>
                        </textarea>
                    </label>
                </div>
            </div>

            <?if($arResult["isUseCaptcha"] == "Y"):?>
                <div>
                    <b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>
                </div>
                <div>
                    <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
                </div>
                <div>
                    <?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
                </div>
            <?endif;?>

            <div class="contact-form__bottom">
                <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                    ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                    данных&raquo;.
                </div>

                <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="form-button contact-form__bottom-button" />


            <?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>

        <?=$arResult["FORM_FOOTER"]?>
    </div>



<? endif; //endif (isFormNote) ?> 
