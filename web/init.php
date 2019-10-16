<?php
require_once '../vendor/autoload.php';

use classes\{
    UserIdentity,
    Helper
};

define('SECONDS_IN_WEEK', 86400);

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();
$dotenv->required(['MYSQL_DSN', 'MYSQL_USER', 'MYSQL_PASSWORD']);

session_start();
if ( !isset($_SESSION['csrfSecret']) || empty($_SESSION['csrfSecret']) ) {
    $_SESSION['csrfSecret'] = Helper::generateRandomString(15);
}

UserIdentity::tryAutoAuth();
