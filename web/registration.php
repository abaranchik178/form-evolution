
<?php
require_once 'init.php';

use \classes\{
    UserMapper,
    User,
    RegistrationForm,
    UserIdentity
};

$registrationErrors = [];

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    //validate
    if ( !empty($_POST['password1']) && !empty ($_POST['password2']) ) {
        if ($_POST['password1'] !== $_POST['password2']) {
            $registrationErrors[] = 'Password and password confirm is not equal';
        }
    } else {
        $registrationErrors[] = 'Please enter password and password confirm';
    }

    //filter

    //

    $registrationForm = new RegistrationForm();
    $registrationForm->loadData($_POST);
    $userState = $registrationForm->getUserState();

    $newUser = new User( $userState );

    $userMapper = new UserMapper();

    if ( $userMapper->findUserByEmail( $newUser->getEmail() ) ) {
        $registrationErrors[] = 'This email address is already use: "' . $newUser->getEmail() . '"';
    }

    if ( empty($registrationErrors) ) {
        $newUserId = $userMapper->addUser($newUser);
        if ($newUserId) {
            $newUser->setId($newUserId);
            UserIdentity::saveAuthSuccess($newUser);
            header('Location: /');
        } else {
            $registrationErrors[] = 'Add user error'; //fixme
        }
    }
}
?>

<!DOCTYPE html>
<head>
    <title>Registration</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="main-container">
    <?php include 'nav.php';?>
    <h3>Registration</h3>
    <div class="errors-block">
        <?php
            if ( !empty($registrationErrors) ) {
                foreach ($registrationErrors as $error) {
                    echo $error;
                }
            }
        ?>
    </div>
    <form method="post">
        <div class="form-field">
            <label for="email">Email Address</label>
            <input name="email" type="email" id="email" placeholder="Enter email">
        </div>
        <div class="form-field">
            <label for="firstName">First Name</label>
            <input name="firstName" type="text" id="firstName" placeholder="Enter first name">
        </div>
        <div class="form-field">
            <label for="lastName">Last Name</label>
            <input name="lastName" type="text" id="lastName" placeholder="Enter last name">
        </div>
        <div class="form-field">
            <label for="password1">Password</label>
            <input name="password1" type="password" id="password1" placeholder="Enter password">
        </div>
        <div class="form-field">
            <label for="password2">Password</label>
            <input name="password2" type="password" id="password2" placeholder="Repeat password">
        </div>
        <div class="form-field">
            <label for="gender">Gender</label>
            <select name="gender" type="text" id="gender">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
        </div>
        <div class="form-field">
            <input name="submit" type="submit">
        </div>
    </form>
</div>
<span class="test-content">Registration page</span>
</body>
