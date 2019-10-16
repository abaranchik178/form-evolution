<?php
require_once '../vendor/autoload.php';

use classes\UserIdentity;

define('SECONDS_IN_WEEK', 86400);

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();
$dotenv->required(['MYSQL_DSN', 'MYSQL_USER', 'MYSQL_PASSWORD']);

session_start();

UserIdentity::tryAutoAuth();
