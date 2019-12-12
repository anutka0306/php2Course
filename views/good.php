
<?php
/**
 * @var App\modules\Good [] $good
 */
?>
<br>
<hr>
<a class="back__btn" href="?c=good&a=all">В Каталог</a>
<hr>
<div class="good__card">
    <div class="good__card_left">
        <h2><?=$good->name?></h2>
        <img src="../<?=$good->image?>" alt="<?=$good->description?>" class="good__card-img">
        <h3><?=$good->price?> RUB.</h3>
    </div>
    <div class="good__card_right">
        <p class="good__card_description">
            <?=$good->description?>
        </p>
    </div>
</div>
<a class="back__btn" href="?c=good&a=all">В Каталог</a>