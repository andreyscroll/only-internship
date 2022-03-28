<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="article-card">
  <div class="article-card__title">
    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
      <h1><?=$arResult["NAME"]?></h1>
    <?endif;?>
  </div>
  <div class="article-card__date">
    <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
      <span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
    <?endif;?>
  </div>
  <div class="article-card__content">
    <div class="article-card__image sticky">
      <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>" />
      <?endif?>
    </div>
    <div class="article-card__text">
      <div class="block-content" data-anim="anim-3">
        <?echo $arResult["DETAIL_TEXT"];?>
      </div>
     </div>
  </div>
</div>
