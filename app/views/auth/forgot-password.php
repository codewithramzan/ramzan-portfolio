<?php

$error = Session::getFlash('error');
$success = Session::getFlash('success');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Forgot Password | Ramzan Khan</title>

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
                <div class="fs-3 fw-bold mb-2">Reset Password</div>
                <p class="text-muted mb-0">
                    Enter your email address and, if an account exists,
                    we'll send instructions to reset your password.
                </p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    <?= e($success) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/forgot-password" novalidate>
                <input
                    type="hidden"
                    name="_csrf"
                    value="<?= e(Csrf::token()) ?>"
                >

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        class="form-control form-control-lg"
                        id="email"
                        name="email"
                        autocomplete="email"
                        maxlength="150"
                        required
                        autofocus
                    >

                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>

                <button class="btn btn-primary btn-lg w-100" type="submit">
                    Send Reset Link
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="/client/login" class="text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to client login
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
