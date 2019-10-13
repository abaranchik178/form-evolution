<?php
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php';?>
    <h3>Login</h3>
    <form>
        <div class="form-field">
            <label for="email">Email Address</label>
            <input name="email" type="email" id="email" placeholder="Enter email">
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="Enter password">
        </div>
    </form>
    <span class="test-content">login page</span>
</body>