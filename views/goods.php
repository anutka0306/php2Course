<p>goods***</p>
<?php
/**
 * @var App\modules\Good [] $goods
 */

foreach ($goods as $good) : ?>
    <h1><?=$good->name?></h1>
<?php
endforeach;
?>

