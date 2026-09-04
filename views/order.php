<?php
session_start();

include dirname(__FILE__, 2) . '/inc/header.php';
include dirname(__FILE__, 2) . '/core/functions.php';

check_authentication();
$products = get_datajson();
$checkouts = get_checkoutjson();


$userId = $_SESSION['user']['id'];

$cart = $_SESSION['cart'][$userId] ?? [];
$totalPrice = 0;

?>

<!-- Header -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Your Order</h1>
            <p class="lead fw-normal text-white-50 mb-0">
                Check your order details
            </p>
        </div>
    </div>
</header>

<!-- Order Section -->

<!-- Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">

        <!-- Customer Information -->
        <h4 class="mb-3">Customer Information</h4>
<?php foreach ($checkouts as $checkout): ?>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><?= $checkout['name'] ?></td>
            </tr>

            <tr>
                <th>Address</th>
                <td><?= $checkout['address'] ?></td>
            </tr>

            <tr>
                <th>Phone</th>
                <td><?= $checkout['phone'] ?></td>
            </tr>
        </table>
<?php endforeach; ?>

        <!-- Order Details -->
        <h4 class="mb-3 mt-5">Order Details</h4>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                                        <?php $index = 1;?>

                               <?php foreach ($products as $product): ?>
                                    <?php
    $productId = $product['id'];

    if (isset($cart[$productId])):

        $quantity = $cart[$productId];

        $price = (float) $product['price'];

        $productTotal = $quantity * $price;

        $totalPrice += $productTotal;
    ?>
                <tr>
                    <td><?= $index++ ?></td>
                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                    <td><?= $quantity ?></td>
                    <td>$<?= $price ?></td>
                    <td>$<?= $productTotal ?></td>
                </tr>


                <?php endif; ?>

<?php endforeach; ?>
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">
                        Total Price
                    </th>

                    <th>
                        $<?= $totalPrice ?>
                    </th>
                </tr>
            </tfoot>

        </table>




    </div>
</section>



<?php
include dirname(__FILE__, 2) . '/inc/footer.php';
?>

