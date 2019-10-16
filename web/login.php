
<?php
require_once 'init.php';

use \classes\{
    UserIdentity,
    LoginForm,
    Helper,
    LoginFormValidator
};

$loginFormValidator = new LoginFormValidator();
$loginForm = new LoginForm();

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    $loginForm->loadData($_POST);

    if ( $loginFormValidator->validate($_POST) ) {
        $userState = $loginForm->getUserState();
        $result = UserIdentity::authByEmail($userState['email'], $userState['password']);
        if (true === $result) {
            header('Location: /');
        } else {
            $err = $result;
        }
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
            <input name="email" type="email" id="email" placeholder="Enter email" value="<?php
                echo $loginForm->getEmail();
            ?>">
            <div class="errors-block">
                <?php echo $loginFormValidator->getErrorsMessagesAsString('email'); ?>
            </div>
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="Enter password">
            <div class="errors-block">
                <?php echo $loginFormValidator->getErrorsMessagesAsString('password'); ?>
            </div>
        </div>
        <div class="form-field">
            <input  type="submit" value="Login">
        </div>
        <?php echo Helper::getCsrfSecretFormInput();?>
    </form>
</div>>
<span class="test-content">login page</span>
</body>