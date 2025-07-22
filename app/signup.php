<?php
include_once('header.php');
include_once('signup_backend.php');
?>

<div class="container-fluid position-relative d-flex p-0">
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Sign Up Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i><?= $appName ?></h3>
                        </a>
                        <h3>Sign Up</h3>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off" id="signupform">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="floatingText" placeholder="jhondoe" required>
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="./">Sign In</a></p>
                    </form>
                    <?php if (isset($error)) {
                        echo '<div class="alert alert-danger mt-2">' . $error . '</div>';
                    } ?>
                    <?php if (isset($success)) {
                        echo '<div class="alert alert-success mt-2">' . $success . '</div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>