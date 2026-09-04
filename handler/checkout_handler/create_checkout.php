<?php
session_start();

require_once dirname(__FILE__, 3) . '/config.php';
require_once dirname(__FILE__, 3) . '/core/functions.php';
require_once dirname(__FILE__, 3) . '/core/validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . Base_URL . "views/contact.php");
    exit;
}

// Retrieve form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$note = trim($_POST['note'] ?? '');

$errors=validate_checkout_data($name, $email, $phone, $address, $note);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;

    header("Location: " . Base_URL . "views/checkout.php");
    exit;
}

    $addcheckout = add_checkout($name, $email, $address, $phone, $note);
if ($addcheckout) {
    setmessage("Details added successfully", 'success');
    header("Location: " . Base_URL . "views/checkout.php");
    exit();
}

setmessage("Unable to save details. Please try again with different message.", 'danger');
header("Location: " . Base_URL . "views/checkout.php");
exit;

