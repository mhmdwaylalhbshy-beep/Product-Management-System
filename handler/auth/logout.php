<?php
session_start();
require_once dirname(__FILE__, 3) . '/config.php';

session_unset();
session_destroy();

header("Location: " . Base_URL . "views/auth/login.php");
exit;
?>