<?php
    require_once 'vendor/autoload.php';
    session_start();
    $user = new \classes\User($_SESSION['userId']);
?>
<!DOCTYPE html>
<head>
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="nav">
        <?php
            if ($user) {
                echo 'Hi ' . $user->getFirstName();
            }
        ?>
    </div>
    <div>
        <a href="registration.php">Registration</a>
        <a href="login.php">Login</a>
        <a href="user-profile.php">Profile</a>
    </div>
</body>
