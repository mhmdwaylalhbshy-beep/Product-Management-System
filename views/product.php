<?php
session_start();
include dirname(__FILE__, 2) . '/inc/header.php';
include dirname(__FILE__, 2) . '/core/functions.php';

$products = get_datajson();
$lastProduct = !empty($products) ? end($products) : null;

check_authentication();


?>

    <!-- Navigation-->
 
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Product Details</h1>
                <p class="lead fw-normal text-white-50 mb-0">Discover the perfect item for your collection</p>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <img class="card-img-top mb-5 mb-md-0" src="<?= Base_URL ?>assets/img/<?= htmlspecialchars($lastProduct['photo']) ?>" alt="Product image" />
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder"><?= htmlspecialchars($lastProduct['product_name']) ?></h1>
                    <div class="fs-5 mb-3">
                        $<?= number_format($lastProduct['price'], 2) ?>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero.</p>

                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <span class="fw-bold">Brand:</span> EraaSoft
                        </div>
                        <div>
                            <span class="fw-bold">Availability:</span> In Stock
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 5rem" />
                        <a class="btn btn-outline-dark flex-shrink-0" href="<?= Base_URL ?>handler/cart_handler/add_cart.php?id=<?= $lastProduct['id'] ?>">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </a>
                    </div>

                    <div class="d-flex gap-2">
                        <a class="btn btn-dark" href="<?=Base_URL?>views/order.php">Buy Now</a>
                        <button class="btn btn-outline-secondary" type="button">Save for Later</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bolder mb-3">Product Description</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.</p>
                            <p>Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($products as $product) { ?>

                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= Base_URL ?>assets/img/<?= htmlspecialchars($product['photo']) ?>" alt="..." />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= htmlspecialchars($product['product_name']) ?></h5>
                                $<?= number_format($product['price'], 2) ?>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= Base_URL ?>handler/cart_handler/add_cart.php?id=<?= $product['id'] ?>">Add to cart</a></div>
                        </div>
                    </div>
                </div>
<?php } ?>
            </div>
        </div>
    </section>

    <!-- Footer-->
<?php
include dirname(__FILE__, 2) . '/inc/footer.php';
?>