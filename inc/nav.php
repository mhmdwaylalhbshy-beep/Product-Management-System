 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?=Base_URL?>index.php">EraaSoft PMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?=Base_URL?>index.php">Home</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/contact.php">Contact</a></li>
<?php if (isset($_SESSION['user']['id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/product.php">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/product_crud/product-create.php">Create Product</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/order.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>handler/auth/logout.php">Logout</a></li>
<?php else: ?>
           <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/auth/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=Base_URL?>views/auth/register.php">Register</a></li>
<?php endif; ?>
                </ul>
                <?php
                $userId = $_SESSION['user']['id'] ?? null;
                $cartCount = $userId !== null? array_sum($_SESSION['cart'][$userId] ?? []): 0;
                ?>
                
                <form class="d-flex" action="<?=Base_URL?>views/cart.php">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            <?= $cartCount ?>
</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
