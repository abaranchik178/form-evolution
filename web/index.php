<?php
    require_once 'init.php';
    use \classes\User;
    session_start();
    if ( isset($_SESSION['userId']) ) {
        $user = new User($_SESSION['userId']);
    }

?>
<!DOCTYPE html>
<head>
    <title>Home</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php';?>
    <div>
        <a href="registration.php">Registration</a>
        <a href="login.php">Login</a>
        <a href="user-profile.php">Profile</a>
    </div>
    <span class="test-content">Home page</span>
</body>
