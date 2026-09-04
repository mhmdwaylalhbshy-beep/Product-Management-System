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
$message = trim($_POST['message'] ?? '');



$errors=validate_contact_data($name, $email, $message);

if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    header("Location: " . Base_URL . "views/contact.php");
    exit;
}

    $addcontact = add_contact($name, $email, $message);

if ($addcontact) {
    setmessage("Contact added successfully", 'success');
    header("Location: " . Base_URL . "views/contact.php");
    exit();
}

setmessage("Unable to save contact message.", 'danger');
header("Location: " . Base_URL . "views/contact.php");
exit;