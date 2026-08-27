<?php

$error = Session::getFlash('error');
$success = Session::getFlash('success');

$oldEmail = Session::getFlash('old_email');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Client login portal for Ramzan Khan."
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    <title>
        Client Login | Ramzan Khan
    </title>

    <!-- Bootstrap 5.3.3 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Application CSS -->
    <link
        rel="stylesheet"
        href="<?= e(asset('css/style.css')) ?>"
    >

    <style>

        body {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(13, 110, 253, 0.08),
                    transparent 35%
                ),
                #f8f9fa;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            border: 0;
            border-radius: 20px;
            overflow: hidden;
            background: #ffffff;
        }

        .auth-card-body {
            padding: 40px;
        }

        .auth-logo {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #212529;
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-control {
            min-height: 50px;
            border-radius: 10px;
        }

        .input-group .form-control {
            border-right: 0;
        }

        .input-group .btn {
            border: 1px solid #dee2e6;
            border-left: 0;
            background: #ffffff;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
        }

        .login-btn {
            min-height: 50px;
            border-radius: 10px;
            font-weight: 600;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
            color: #6c757d;
            font-size: 14px;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #dee2e6;
        }

        .security-note {
            font-size: 13px;
            color: #6c757d;
        }

        .back-home {
            text-decoration: none;
        }

        @media (max-width: 576px) {

            .auth-card-body {
                padding: 28px 22px;
            }

        }

    </style>

</head>

<body>

<div class="auth-wrapper">

    <div class="card auth-card shadow-lg">

        <div class="auth-card-body">

            <!-- Brand -->
            <div class="text-center">

                <a
                    href="/"
                    class="text-decoration-none text-dark"
                    aria-label="Go to homepage"
                >

                    <div class="auth-logo">
                        RK
                    </div>

                </a>

                <h1 class="h3 fw-bold mb-2">
                    Welcome Back
                </h1>

                <p class="text-muted mb-4">
                    Sign in to your client account
                </p>

            </div>


            <!-- Error Message -->
            <?php if ($error): ?>

                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                >

                    <div class="d-flex align-items-start">

                        <i class="bi bi-exclamation-circle-fill me-2 mt-1"></i>

                        <div>
                            <?= e($error) ?>
                        </div>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- Success Message -->
            <?php if ($success): ?>

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >

                    <div class="d-flex align-items-start">

                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>

                        <div>
                            <?= e($success) ?>
                        </div>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- Login Form -->
            <form
                method="POST"
                action="/client/login"
                id="clientLoginForm"
                novalidate
            >

                <!-- CSRF -->
                <input
                    type="hidden"
                    name="_csrf"
                    value="<?= e(Csrf::token()) ?>"
                >


                <!-- Email -->
                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label fw-semibold"
                    >
                        Email Address
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="<?= e($oldEmail ?? '') ?>"
                            placeholder="you@example.com"
                            autocomplete="email"
                            maxlength="150"
                            required
                            autofocus
                        >

                    </div>

                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>

                </div>


                <!-- Password -->
                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <label
                            for="password"
                            class="form-label fw-semibold"
                        >
                            Password
                        </label>

                        <a
                            href="/forgot-password"
                            class="small text-decoration-none"
                        >
                            Forgot password?
                        </a>

                    </div>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="btn"
                            id="togglePassword"
                            aria-label="Show password"
                            aria-pressed="false"
                        >

                            <i
                                class="bi bi-eye"
                                id="passwordIcon"
                            ></i>

                        </button>

                    </div>

                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>

                </div>


                <!-- Remember Me -->
                <div class="form-check mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember"
                        name="remember"
                        value="1"
                    >

                    <label
                        class="form-check-label"
                        for="remember"
                    >
                        Remember me
                    </label>

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="btn btn-primary w-100 login-btn"
                    id="loginButton"
                >

                    <span id="loginButtonText">
                        Sign In
                    </span>

                    <span
                        id="loginSpinner"
                        class="spinner-border spinner-border-sm d-none ms-2"
                        aria-hidden="true"
                    ></span>

                </button>

            </form>


            <div class="auth-divider">
                OR
            </div>


            <!-- Registration -->
            <div class="text-center">

                <p class="mb-2 text-muted">
                    Don't have an account?
                </p>

                <a
                    href="/client/register"
                    class="btn btn-outline-dark w-100"
                >
                    Create Client Account
                </a>

            </div>


            <!-- Security -->
            <div class="text-center mt-4">

                <p class="security-note mb-2">

                    <i class="bi bi-shield-lock me-1"></i>

                    Your connection and account information
                    are protected.

                </p>

                <a
                    href="/"
                    class="back-home small"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to portfolio
                </a>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script>

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("clientLoginForm");

    const password = document.getElementById("password");

    const togglePassword =
        document.getElementById("togglePassword");

    const passwordIcon =
        document.getElementById("passwordIcon");

    const loginButton =
        document.getElementById("loginButton");

    const loginButtonText =
        document.getElementById("loginButtonText");

    const loginSpinner =
        document.getElementById("loginSpinner");


    /*
    |--------------------------------------------------------------------------
    | Toggle Password Visibility
    |--------------------------------------------------------------------------
    */

    if (togglePassword) {

        togglePassword.addEventListener("click", function () {

            const isPassword =
                password.type === "password";

            password.type =
                isPassword ? "text" : "password";

            passwordIcon.className =
                isPassword
                    ? "bi bi-eye-slash"
                    : "bi bi-eye";

            togglePassword.setAttribute(
                "aria-label",
                isPassword
                    ? "Hide password"
                    : "Show password"
            );

            togglePassword.setAttribute(
                "aria-pressed",
                isPassword ? "true" : "false"
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Client-side Validation
    |--------------------------------------------------------------------------
    */

    if (form) {

        form.addEventListener("submit", function (event) {

            if (!form.checkValidity()) {

                event.preventDefault();

                event.stopPropagation();

            } else {

                loginButton.disabled = true;

                loginButtonText.textContent =
                    "Signing in...";

                loginSpinner.classList.remove(
                    "d-none"
                );

            }

            form.classList.add("was-validated");

        });

    }

});

</script>

</body>

</html>