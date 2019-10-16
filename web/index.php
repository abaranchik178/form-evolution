<?php
    require_once 'init.php';
    use \classes\{
        User,
        UserMapper
    };
    session_start();
    if ( isset($_SESSION['userId']) ) {
        $db = new UserMapper();
        $user = $db->findUserById($_SESSION['userId']);
    }
?>
<!DOCTYPE html>
<head>
    <title>Home</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="main-container">
    <?php include 'nav.php';?>
    <div>
        <a href="registration.php">Registration</a>
        <a href="login.php">Login</a>
        <a href="user-profile.php">Profile</a>
    </div>
</div>
<span class="test-content">Home page</span>
</body>
