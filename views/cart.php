<?php

session_start();

include dirname(__FILE__, 2) . '/core/functions.php';

check_authentication();

include dirname(__FILE__, 2) . '/inc/header.php';

$products = get_datajson();

$userId = $_SESSION['user']['id'];

$cart = $_SESSION['cart'][$userId] ?? [];

$totalPrice = 0;

?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Your Cart</h1>
            <p class="lead fw-normal text-white-50 mb-0">
                Your selected products
            </p>
        </div>
    </div>
</header>

<!-- Cart -->
<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (empty($cart)): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Your cart is empty
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $index = 1;?>
                        <?php foreach ($products as $product): ?>
                            <?php
                            $productId = $product['id'];
                            if (isset($cart[$productId])):
                                $quantity = $cart[$productId];
                                $price = (float) $product['price'];
                                $productTotal = $price * $quantity;
                                $totalPrice += $productTotal;
                            ?>

                            <tr>
                                <th scope="row"><?= $index++ ?></th>
                                <td><?= htmlspecialchars($product['product_name']) ?></td>
                                <td>$<?= number_format($price, 2) ?></td>
                                <td><input type="number"value="<?= $quantity ?>"min="1"class="form-control"style="width: 80px;"></td>
                                <td><?= number_format($productTotal, 2) ?></td>
                                <td><a href="<?= Base_URL ?>handler/cart_handler/delete_cart.php?id=<?= $productId ?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>

                            <td colspan="2"><strong>Total Price</strong> </td>
                            <td colspan="3">
                                <h3><?= number_format($totalPrice, 2) ?> </h3>
                            </td>
                            <td> <a href="checkout.php"class="btn btn-primary">Checkout</a>  </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
                 </div>
        </div>
    </div>

</section>

<?php

include dirname(__FILE__, 2) . '/inc/footer.php';

?>