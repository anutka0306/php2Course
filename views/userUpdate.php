
<?php
/**
 * @var App\modules\User [] $user
 */
?>
<h2>Add new User</h2>
<form action="?c=user&a=update&id=<?=$user->id?>" method="post">
   Name <input type="text" name="name" value="<?=$user->name?>"><br>
    Login <input type="text" name="login" value="<?=$user->login?>"><br>
   Password <input type="text" name="password"><br>
    Role <input type="text" name="role" value="<?=$user->role?>"><br>
    Tel <input type="text" name="tel" value="<?=$user->tel?>"><br>
    <input type="submit" value="Send">
</form>

