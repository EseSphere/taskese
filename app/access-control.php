<?php
include_once('header-panel.php');
include_once('sub-header.php');

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = trim($_POST['email'] ?? '');

    if (empty($emailInput)) {
        $errorMessage = "The email field is required.";
    } else {
        $validatedEmail = filter_var($emailInput, FILTER_VALIDATE_EMAIL);
        if ($validatedEmail === false) {
            $errorMessage = "Please enter a valid email address.";
        } else {
            $encodedEmail = base64_encode($validatedEmail);
            $inviteUrl = "https://yourdomain.com/register.php?invite=" . urlencode($encodedEmail);

            $subject = "Invitation to Join Our Platform";
            $body = <<<EOD
Hello,

You have been invited to join our platform. Please click the link below to accept your invitation:

$inviteUrl

Thank you,
The Team
EOD;

            $headers = "From: no-reply@yourdomain.com\r\n";
            $mailSent = mail($validatedEmail, $subject, $body, $headers);

            if ($mailSent) {
                $successMessage = "An invitation has been successfully sent to {$validatedEmail}.";
            } else {
                $errorMessage = "There was an error sending the invitation. Please try again later.";
            }
        }
    }
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-left">
        <div class="row text-decoration-none">
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <h5 class="mb-4 text-light">Access Control</h5>

                    <?php if ($successMessage): ?>
                        <div class="alert alert-success" role="alert"><?= htmlspecialchars($successMessage) ?></div>
                    <?php endif; ?>

                    <?php if ($errorMessage): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
                    <?php endif; ?>

                    <form method="post" novalidate>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label text-light">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                id="inputEmail"
                                class="form-control"
                                placeholder="Enter email address"
                                required
                                autofocus
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Send Invitation</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8 col-xl-8">
                <div class="bg-secondary rounded h-100 p-4">
                    <h5 class="mb-4 text-light">Access Control Invitation</h5>
                    <p class="text-light">
                        This page enables authorized users to invite trusted individuals to join our platform securely. By sending a personalized invitation link via email, we ensure that new members gain access only through a controlled and verified process. This approach helps us maintain the integrity and security of our community by preventing unauthorized registrations.
                        <br><br>
                        Inviting users through this system allows us to provide a seamless onboarding experience while safeguarding sensitive information and resources. Please enter the email address of the person you wish to invite below. They will receive a secure link to complete their registration and become part of our platform.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer-panel.php'); ?>