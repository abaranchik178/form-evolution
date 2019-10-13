<?php
require_once '../vendor/autoload.php';
error_log('../' . __DIR__);
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();
$dotenv->required(['MYSQL_DSN', 'MYSQL_USER', 'MYSQL_PASSWORD']);

