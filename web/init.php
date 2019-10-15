<?php
require_once '../vendor/autoload.php';

use classes\UserMapper;

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();
$dotenv->required(['MYSQL_DSN', 'MYSQL_USER', 'MYSQL_PASSWORD']);

if ( isset($_SESSION['userId']) && !empty($_SESSION['userId']) ) {
    $db = new UserMapper;
    $user = $db->findUserById($_SESSION['userId']);
}