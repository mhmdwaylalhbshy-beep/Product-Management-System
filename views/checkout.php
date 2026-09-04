<?php
session_start();

include dirname(__FILE__, 2) . '/inc/header.php';
include dirname(__FILE__, 2) . '/core/functions.php';
check_authentication();
$products = get_datajson();


$userId = $_SESSION['user']['id'];

$cart = $_SESSION['cart'][$userId] ?? [];
$totalPrice = 0;

?>
    <!-- Navigation-->

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>

    <?= showmessage('success') ?>
    
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-4">
                    <div class="border p-2">
                        <div class="products">
                            <ul class="list-unstyled">
                                <?php foreach ($products as $product): ?>
                                    <?php
    $productId = $product['id'];

    if (isset($cart[$productId])):

        $quantity = $cart[$productId];

        $price = (float) $product['price'];

        $productTotal = $quantity * $price;

        $totalPrice += $productTotal;
    ?>
                                <li class="border p-2 my-1"><?= htmlspecialchars($product['product_name']) ?>

                                    <span class="text-success mx-2 mr-auto bold"><?= $quantity ?> x $<?= $price ?></span>
                                </li>

                                                            <?php endif; ?>

<?php endforeach; ?>
                            </ul>
                        </div>

                        <h3>Total : <?= $totalPrice ?></h3>
                    </div>
                </div>
<div class="col-8">
    <form action="<?= Base_URL ?>handler/checkout_handler/create_checkout.php"
          method="POST"
          class="form border my-2 p-3">

        <div class="mb-3">

            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
                <?= showmessage('error', 'name') ?>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <?= showmessage('error', 'email') ?>
            </div>

            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
                <?= showmessage('error', 'address') ?>
            </div>

            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
                <?= showmessage('error', 'phone') ?>
            </div>

            <div class="mb-3">
                <label for="note">Notes</label>
                <input type="text" name="note" id="note" class="form-control">
                <?= showmessage('error', 'note') ?>
            </div>

            <div class="mb-3">
                <input type="submit" value="Send" class="btn btn-success">
            </div>

        </div>
    </form>
</div>
            </div>
        </div>
    </section>
    <!-- Footer-->
<?php
unset($_SESSION['errors']);

include dirname(__FILE__, 2) . '/inc/footer.php';
?>