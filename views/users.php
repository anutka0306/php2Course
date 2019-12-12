<?php
/**
 * @var App\modules\User [] $users
 */

foreach ($users as $user) : ?>
    <h1><a href="?c=user&a=one&id=<?=$user->id?>"><?=$user->login?></a></h1>
<?php
endforeach;
?>
