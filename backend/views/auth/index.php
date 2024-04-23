<?php
require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/controllers/AuthController.php';
$authController = new AuthController();
$error_message = $authController->actionLogin();
require_once 'includes/header.php';

?>
<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="bg-dark p-4">
                <h2 class="text-center text-white mb-3">Login</h2>
                <form action="" method="POST" id="authForm">
                    <div class="form-floating">
                        <input type="text" class="form-control bg-dark text-white rounded-bottom-0" id="username" name="username" placeholder=" " autocomplete="on" required>
                        <label for="username" class="text-white">Username</label>
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control bg-dark text-white rounded-top-0" id="password" name="password" placeholder=" " autocomplete="current-password" required>
                        <label for="password" class="text-white">Password</label>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100 my-4">Login</button>
                </form>
                <?php 
                if (!empty($error_message)) {
                    echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">
                    ' . $error_message . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }                
                ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_PATH; ?>assets/js/auth.js"></script>

<?php
require_once 'includes/footer.php';
?>
