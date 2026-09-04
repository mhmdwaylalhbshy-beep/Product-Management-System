<?php
session_start();
include dirname(__FILE__, 3) . '/inc/header.php';
include dirname(__FILE__, 3) . '/core/functions.php';

?>
    <!-- Navigation-->

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Login</h1>
                <p class="lead fw-normal text-white-50 mb-0">Please login to continue</p>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-8 mx-auto">

<form action="<?= Base_URL ?>handler/auth/create_login.php" method="post" class="form border my-2 p-3">                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                                                                <?= showmessage('error', 'email') ?>

                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <?= showmessage('error', 'password') ?>

                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Login" id="" class="btn btn-success">
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
include dirname(__FILE__, 3) . '/inc/footer.php';
?>