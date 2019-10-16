
<?php
require_once 'init.php';

use \classes\{
    UserMapper,
    User,
    RegistrationForm,
    UserIdentity,
    Helper,
    RegistrationFormValidaror
};

$registrationFormValidator = new RegistrationFormValidaror();
$registrationForm = new RegistrationForm();


if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    $registrationForm->loadData($_POST);
    if ( $registrationFormValidator->validate($_POST) ) {

        $userState = $registrationForm->getUserState();
        $newUser = new User( $userState );
        $userMapper = new UserMapper();

        $newUser->setSecretString( Helper::generateRandomString() );
        $newUserId = $userMapper->addUser($newUser);
        if ($newUserId) {
            $newUser->setId($newUserId);
            UserIdentity::saveAuthSuccess($newUser);
            header('Location: /');
        } else {
            throw new RuntimeException('Failed to register user');
        }

    } else {
        error_log(print_r( $registrationFormValidator->getErrors(),1) );
    }


}

//for save form state after reload page
$selectedGender = $registrationForm->getGender();
$selectedMale = $selectedFemale = '';
switch ($selectedGender) {
    case 'male':
        $selectedMale = 'selected';
        break;
    case 'female':
        $selectedFemale = 'selected';
        break;
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

    <form method="post">
        <div class="form-field">
            <label for="email">Email Address</label>
            <input name="email" type="email" id="email" placeholder="Enter email" value="<?php
                echo $registrationForm->getEmail();
            ?>">
            <div class="errors-block">
                <?php echo $registrationFormValidator->getErrorsMessagesAsString('email'); ?>
            </div>
        </div>
        <div class="form-field">
            <label for="firstName">First Name</label>
            <input name="firstName" type="text" id="firstName" placeholder="Enter first name" value="<?php
                echo $registrationForm->getFirstName();
            ?>">
            <div class="errors-block">
                <?php echo $registrationFormValidator->getErrorsMessagesAsString('firstName'); ?>
            </div>
        </div>
        <div class="form-field">
            <label for="lastName">Last Name</label>
            <input name="lastName" type="text" id="lastName" placeholder="Enter last name" value="<?php
                echo $registrationForm->getLastName();
            ?>">
            <div class="errors-block">
                <?php echo $registrationFormValidator->getErrorsMessagesAsString('lastName'); ?>
            </div>
        </div>
        <div class="form-field">
            <label for="password1">Password</label>
            <input name="password1" type="password" id="password1" placeholder="Enter password">
            <div class="errors-block">
                <?php echo $registrationFormValidator->getErrorsMessagesAsString('password1'); ?>
            </div>
        </div>
        <div class="form-field">
            <label for="password2">Password</label>
            <input name="password2" type="password" id="password2" placeholder="Repeat password">
            <div class="errors-block">
                <?php echo $registrationFormValidator->getErrorsMessagesAsString('password2'); ?>
            </div>
        </div>
        <div class="form-field">
            <label for="gender">Gender</label>
            <select name="gender" type="text" id="gender" >
                <option <?= $selectedMale ?> value="male">male</option>
                <option <?= $selectedFemale ?>  value="female">female</option>
            </select>
            <div class="errors-block">
                <?php echo $registrationFormValidator->getErrorsMessagesAsString('gender'); ?>
            </div>
        </div>
        <div class="form-field">
            <input name="submit" type="submit">
        </div>
        <?php echo Helper::getCsrfSecretFormInput(); ?>
    </form>
</div>
<span class="test-content">Registration page</span>
</body>
