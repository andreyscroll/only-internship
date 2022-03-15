<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["isFormErrors"] == "Y"){
	echo $arResult["FORM_ERRORS_TEXT"];
}
?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y"):?>

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

	    <?=$arResult["FORM_HEADER"]?>
	        <div class="contact-form__form-inputs">

	        	<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
	        		<?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):?>
	        			<?=$arQuestion["HTML_CODE"]?>
	        		<? else:?>

	        			<div class="input contact-form__input">
			            	<label class="input__label" for="medicine_name">
			                <div class="input__label-text">
			                	<?=$arQuestion["CAPTION"]?>
			                	<?if ($arQuestion["REQUIRED"] == "Y") echo $arResult["REQUIRED_SIGN"];?>
			                </div>
			                <!-- <input class="input__input" type="text" id="medicine_name" name="medicine_name" value="" required=""> -->

			                <? $arQuestion["HTML_CODE"] = preg_replace('(inputtext|inputtextarea)', 'input_input', $arQuestion["HTML_CODE"]); ?>
			                <?=$arQuestion["HTML_CODE"]?>

			                <div class="input__notification">
			                	<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
			                		<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>
			                	<?endif;?>
			                </div>
			            	</label>
			            </div>

	        		<?endif;?>
	        	<?endforeach;?>

	        <div class="contact-form__bottom">
	            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
	                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
	                данных&raquo;.
	            </div>

	            <button class="form-button contact-form__bottom-button" data-success="Отправлено" data-error="Ошибка отправки">
	                <div class="form-button__title">
	                	<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>
	                </div>
	            </button>
	        </div>

	    <?=$arResult["FORM_FOOTER"]?>
	</div>



<? endif; //endif (isFormNote) ?> 
