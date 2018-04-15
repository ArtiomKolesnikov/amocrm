<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
$root = __DIR__ . DIRECTORY_SEPARATOR;
require $root .'auth.php';
require $root .'account_current.php';
require $root . 'get_leads_without_tasks.php';
require $root . 'add_tasks.php';
?>