<?php
session_start();
require_once dirname(__FILE__, 3) . '/config.php';
require_once dirname(__FILE__, 3) . '/core/functions.php';
require_once dirname(__FILE__, 3) . '/core/validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . Base_URL . "views/auth/register.php");
    exit;
}

// Retrieve form data
$email = trim($_POST['email'] ?? '');
$password=trim($_POST['password'] ?? '');

$errors=validate_login_data($email, $password);

if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    header("Location: " . Base_URL . "views/auth/login.php");
    exit;
}

$loginuser = login_user($email, $password);

if ($loginuser === true) {

    setmessage("Login successfully", "success");

    header("Location: " . Base_URL . "index.php");
    exit();

} else {

    setmessage("Unable to login", "danger");

    header("Location: " . Base_URL . "views/auth/login.php");
    exit();
}
