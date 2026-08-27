<?php

$error = Session::getFlash('error');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Reset Password | Ramzan Khan</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >
    <link
        rel="stylesheet"
        href="<?= e(asset('css/style.css')) ?>"
    >
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="card border-0 shadow-sm rounded-4 w-100" style="max-width:460px;">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <div class="fs-3 fw-bold mb-2">Choose a New Password</div>
                <p class="text-muted mb-0">
                    Use a strong password you do not use elsewhere.
                </p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/reset-password" id="resetPasswordForm">
                <input
                    type="hidden"
                    name="_csrf"
                    value="<?= e(Csrf::token()) ?>"
                >

                <input
                    type="hidden"
                    name="token"
                    value="<?= e($token ?? '') ?>"
                >

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        New Password
                    </label>

                    <input
                        type="password"
                        class="form-control form-control-lg"
                        id="password"
                        name="password"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        class="form-control form-control-lg"
                        id="password_confirmation"
                        name="password_confirmation"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >

                    <div id="passwordMessage" class="small mt-2"></div>
                </div>

                <button class="btn btn-primary btn-lg w-100" type="submit">
                    Update Password
                </button>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('resetPasswordForm');
    const password = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');
    const message = document.getElementById('passwordMessage');

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity() || password.value !== confirmation.value) {
            event.preventDefault();
            form.classList.add('was-validated');

            if (password.value !== confirmation.value) {
                message.textContent = 'Passwords do not match.';
                message.className = 'small mt-2 text-danger';
            }
        }
    });

    confirmation.addEventListener('input', function () {
        if (!confirmation.value) {
            message.textContent = '';
            return;
        }

        if (password.value === confirmation.value) {
            message.textContent = 'Passwords match.';
            message.className = 'small mt-2 text-success';
        } else {
            message.textContent = 'Passwords do not match.';
            message.className = 'small mt-2 text-danger';
        }
    });
});
</script>

</body>
</html>
