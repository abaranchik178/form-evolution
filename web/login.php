
<?php
require_once 'init.php';

use \classes\{
    UserIdentity,
    LoginForm
};

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    $registrationForm = new LoginForm();
    $registrationForm->loadData($_POST);
    $userState = $registrationForm->getUserState();

    $result = UserIdentity::authByEmail($userState['email'], $userState['password']);
    if (true === $result) {
        header('Location: /');
    } else {
        $err = $result;
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="main-container">
    <?php include 'nav.php';?>
    <h3>Login</h3>
        <?php
            if ( isset($err) ) {
                echo $err;
            }
        ?>
    <form method="post">
        <div class="form-field">
            <label for="email">Email Address</label>
            <input name="email" type="email" id="email" placeholder="Enter email">
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="Enter password">
        </div>
        <div class="form-field">
            <input  type="submit" value="Login">
        </div>
    </form>
</div>>
<span class="test-content">login page</span>
</body>