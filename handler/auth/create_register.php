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
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password=trim($_POST['password'] ?? '');
$confirm_password=trim($_POST['confirm_password'] ?? '');

$errors=validate_register_data($name, $email, $password, $confirm_password);

if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    header("Location: " . Base_URL . "views/auth/register.php");
    exit;
}

$addclient = add_client($name, $email, $password);

if ($addclient) {
    setmessage("your register is successfully", 'success');
    header("Location: " . Base_URL . "index.php");
    exit();
}

setmessage("Unable to save client data.", 'danger');
header("Location: " . Base_URL . "views/auth/register.php");
exit;
