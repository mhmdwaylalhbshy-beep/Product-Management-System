<?php

session_start();

require_once dirname(__FILE__, 3) . '/config.php';
require_once dirname(__FILE__, 3) . '/core/functions.php';

check_authentication();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: " . Base_URL . "views/cart.php");
    exit;
}

$userId = $_SESSION['user']['id'];

if (isset($_SESSION['cart'][$userId][$id])) {
    unset($_SESSION['cart'][$userId][$id]);
    save_user_cart($userId, $_SESSION['cart'][$userId]);
}

header("Location: " . Base_URL . "views/cart.php");
exit;