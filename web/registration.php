
<?php
use \classes\{
    DB,
    User
};

session_start();

$registrationErrors = [];

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    $user = new User($_POST);
    $db = new DB();

    if ( $db->findUserByEmail( $user->getEmail() ) ) {
        $registrationErrors[] = 'This email address is already use: "' . $user->getEmail() . '"';
    } else {
        $userId = $db->addUser($user);
        $_SESSION['userId'] = $userId;
        header('Location: /');
    }
}
?>

<!DOCTYPE html>
<head>
    <title>Registration</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
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
<form>
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
        <label for="birthDate">Birth Date</label>
        <input type="date" id="birthDate" name="birthDate">
    </div>
    <div class="form-field">
        <label for="avatar">Avatar</label>
        <input type="file" id="avatar" name="avatar">
    </div>
    <div class="form-field">
        <input type="submit">
    </div>
</form>
</body>
