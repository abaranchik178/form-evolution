<div class="nav">
    <a href="index.php">Home </a>
    <div class="user-state">
        <?php
        if ( isset($user) && $user instanceof \classes\User) {
            echo 'Hi ' . $user->getFirstName();
        }
        ?>
    </div>
</div>