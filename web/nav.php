<?php
    use classes\{
        User,
        UserIdentity
    };
?>

<div class="nav">
    <a href="index.php">Home </a>
    <div class="user-state">
        <?php
        $user = UserIdentity::getUser();
        if ( $user instanceof User) {
            echo 'Hi ' . $user->getFirstName();
        } else {
            error_log(print_r('-----------------------------------',1));
            error_log(print_r($user,1));
        }
        ?>
    </div>
</div>