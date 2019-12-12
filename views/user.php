
<?php
/**
 * @var App\modules\User [] $user
 */
?>
    <h1><?=$user->login?></h1>
    <p><?=$user->name?></p>
    <p><?=$user->tel?></p>
    <p><?=$user->role?></p>

<a href="?c=user&a=update&id=<?=$user->id?>">Edit User</a>