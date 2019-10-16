<?php
require_once 'init.php';
use \classes\{
    User,
    UserMapper
};
if ( isset($_SESSION['userId']) ) {
    $db = new UserMapper();
    $user = $db->findUserById($_SESSION['userId']);
}
?>
<!DOCTYPE html>
<head>
    <title>User</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php';?>
<?php if ( isset($user) ) { ?>
    <img src="">
    email: <?= $user->getEmail() ?>
    name: <?= $user->getFirstName() ?>
    gender: <?= $user->getGender() ?>
<?php } ?>
<span class="test-content">User profile page</span>
</body>

