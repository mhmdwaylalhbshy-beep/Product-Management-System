<?php
session_start();

include dirname(__FILE__) . '/inc/header.php';
include dirname(__FILE__) . '/core/functions.php';
$products = get_datajson();

?>
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
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
<?php foreach ($products as $product) { ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= Base_URL ?>assets/img/<?= htmlspecialchars($product['photo']) ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= htmlspecialchars($product['product_name']) ?></h5>
                                <!-- Product price-->
                                $<?= number_format($product['price'], 2) ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?=Base_URL?>handler/cart_handler/add_cart.php?id=<?= $product['id'] ?>">Add to cart</a></div>
                        </div>
                    </div>
                </div>
<?php } ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
<?php
include dirname(__FILE__) . '/inc/footer.php';
?>