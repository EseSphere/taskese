<?php
include_once('header.php');
include_once('./back_ends/verify_backend.php');
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
                        <a href="./" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i><?= $appName ?></h3>
                        </a>
                        <h5 class="text-light">Sign Up</h3>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off" id="signupform">
                        <div class="form-floating mb-3">
                            <p class="text-muted mb-0">
                                <strong style="color:red;">Note:</strong> Please enter the verification code that has been sent to your email address to complete the account verification process. If you don’t see the email, be sure to check your spam or junk folder.
                            </p>
                        </div>
                        <hr>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="verification" id="floatingText" placeholder="Verification Code" required>
                            <label for="floatingText">Verification Code</label>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Continue</button>
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