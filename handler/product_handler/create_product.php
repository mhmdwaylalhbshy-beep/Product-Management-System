<?php
session_start();

require_once dirname(__FILE__, 3) . '/config.php';
require_once dirname(__FILE__, 3) . '/core/functions.php';
require_once dirname(__FILE__, 3) . '/core/validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . Base_URL . "views/product_crud/product-create.php");
    exit;
}

// Retrieve form data
$product_name = trim($_POST['product_name'] ?? '');
$category = trim($_POST['category'] ?? '');
$price = trim($_POST['price'] ?? '');
$stock = trim($_POST['stock'] ?? '');
$photo = $_FILES['photo'] ?? null;
$description = trim($_POST['description'] ?? '');
$status = trim($_POST['status'] ?? '');

$errors=validate_product_data($product_name, $category, $price, $stock, $photo, $description, $status);

  
if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    header("Location: " . Base_URL . "views/product_crud/product-create.php");
    exit;
}
$ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
$imageName = uniqid("image_") . '.' . strtolower($ext);
$imagePath = dirname(__FILE__, 3) . '/assets/img/' . $imageName;
if (!move_uploaded_file($photo['tmp_name'], $imagePath)) {
    die("Error uploading file");
}

    $addproduct = add_product($product_name, $category, $price, $stock, $imageName, $description, $status);

if ($addproduct) {
    setmessage("Product added successfully", 'success');
    header("Location: " . Base_URL . "views/product_crud/product-create.php");
    exit();
}
?>