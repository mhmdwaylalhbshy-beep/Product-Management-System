<?php
session_start();

require_once dirname(__FILE__, 3) . '/core/functions.php';
require_once dirname(__FILE__, 3) . '/inc/header.php';
$error = $_SESSION['errors'] ?? [];

check_authentication();


?>

    <!-- Navigation-->

    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Create Product</h1>
                <p class="lead fw-normal text-white-50 mb-0">Add a new product to your store</p>
            </div>
        </div>
    </header>

    <?= showmessage('success') ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
<form action="<?= Base_URL ?>handler/product_handler/create_product.php" method="post" enctype="multipart/form-data">       
                 <div class="mb-3">
                        <label for="product_name" class="form-label fw-bold">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-control border border-success" placeholder="Enter product name" >                        
                    <?= showmessage('error','product_name') ?>
                    </div>

                    <div class="mb-3">
                        <label for="product_category" class="form-label fw-bold">Category</label>
                        <select id="product_category" name="category" class="form-select border border-success" >
                            <option value="">Select category</option>
                            <option value="1">Sports Cars</option>
                            <option value="2">SUVs</option>
                            <option value="3">Sedans</option>
                            <option value="4">Electric Cars</option>
                            <option value="5">Luxury Cars</option>
                        </select>
                                        <?= showmessage('error','category') ?>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Price</label>
                            <input type="number" id="price" name="price" class="form-control border border-success" step="0.01"  placeholder="0.00" >
                                           <?= showmessage('error','price') ?>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label fw-bold">Stock Quantity</label>
                            <input type="number" id="stock" name="stock" class="form-control border border-success" min="0" value="1" >
                            <?= showmessage('error','stock') ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label fw-bold">Product Photo</label>
                        <input type="file" id="photo" name="photo" class="form-control border border-success">
                        <?= showmessage('error','photo') ?>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea id="description" name="description" rows="5" class="form-control border border-success" placeholder="Write a short product description..." ></textarea>
                                       <?= showmessage('error','description') ?>

                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold d-block">Status</label>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                        <label class="form-check-label" for="active">Active</label>
                        <?= showmessage('error','status') ?>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                            <label class="form-check-label" for="inactive">Inactive</label>
                                            <?= showmessage('error','status') ?>

                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <input type="submit"  href="<?= Base_URL ?>views/product.php" value="Add Product" class="btn btn-primary px-4">
                        <a href="<?= Base_URL ?>views/product_crud/product-create.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
unset($_SESSION['errors']);
?>
    <!-- Footer-->
<?php
include dirname(__FILE__, 3) . '/inc/footer.php';
?>