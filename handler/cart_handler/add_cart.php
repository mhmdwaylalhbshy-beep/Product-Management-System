<?php

session_start();

require_once dirname(__FILE__, 3) . '/config.php';
require_once dirname(__FILE__, 3) . '/core/functions.php';

check_authentication();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: " . Base_URL . "views/product.php");
    exit;
}

$userId = $_SESSION['user']['id'];

// لو مفيش cart للمستخدم ده اعملها
if (!isset($_SESSION['cart'][$userId])) {
    $_SESSION['cart'][$userId] = [];
}

// لو المنتج موجود زود الكمية
if (isset($_SESSION['cart'][$userId][$id])) {

    $_SESSION['cart'][$userId][$id]++;

} else {

    // أول مرة يتضاف
    $_SESSION['cart'][$userId][$id] = 1;
}

save_user_cart($userId, $_SESSION[' cart'][$userId]);

header("Location: " . Base_URL . "views/cart.php");
exit;