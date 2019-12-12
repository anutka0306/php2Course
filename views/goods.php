<p>goods***</p>
<?php
/**
 * @var App\modules\Good [] $goods
 */
?>
<div class="catalog_wrap">
<?php
foreach ($goods as $good) : ?>
<div class="catalog_item">
    <h3><a href="?c=good&a=one&id=<?=$good->id?>"><?=$good->name?></a></h3>
    <a href="?c=good&a=one&id=<?=$good->id?>">
        <img src="../<?=$good->image?>" alt="<?=$good->description?>" class="catalog_item-img">
    </a>
</div>
<?php
endforeach;
?>
</div>

