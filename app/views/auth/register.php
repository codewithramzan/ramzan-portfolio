<?php

$error = Session::getFlash('error');
$success = Session::getFlash('success');

$oldName = Session::getFlash('old_name');
$oldEmail = Session::getFlash('old_email');
$oldPhone = Session::getFlash('old_phone');

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
        content="Create a client account with Ramzan Khan."
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    <title>
        Create Account | Ramzan Khan
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
                    circle at top right,
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
            max-width: 500px;
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

        .register-btn {
            min-height: 50px;
            border-radius: 10px;
            font-weight: 600;
        }

        .password-strength {
            height: 5px;
            border-radius: 5px;
            background: #e9ecef;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.25s ease;
        }

        .password-requirements {
            font-size: 13px;
        }

        .password-requirements li {
            margin-bottom: 4px;
        }

        .requirement-valid {
            color: #198754;
        }

        .requirement-invalid {
            color: #6c757d;
        }

        .security-note {
            font-size: 13px;
            color: #6c757d;
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


            <!-- Header -->
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
                    Create Your Account
                </h1>

                <p class="text-muted mb-4">
                    Create a client account to work with me,
                    submit applications and manage conversations.
                </p>

            </div>


            <!-- Error -->
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


            <!-- Success -->
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


            <!-- Registration Form -->
            <form
                method="POST"
                action="/client/register"
                id="clientRegisterForm"
                novalidate
            >

                <!-- CSRF -->
                <input
                    type="hidden"
                    name="_csrf"
                    value="<?= e(Csrf::token()) ?>"
                >


                <!-- Name -->
                <div class="mb-3">

                    <label
                        for="name"
                        class="form-label fw-semibold"
                    >
                        Full Name
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-person"></i>
                        </span>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="<?= e($oldName ?? '') ?>"
                            placeholder="Enter your full name"
                            autocomplete="name"
                            maxlength="100"
                            minlength="2"
                            required
                            autofocus
                        >

                    </div>

                    <div class="invalid-feedback">
                        Please enter your full name.
                    </div>

                </div>


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
                        >

                    </div>

                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>

                </div>


                <!-- Phone -->
                <div class="mb-3">

                    <label
                        for="phone"
                        class="form-label fw-semibold"
                    >
                        Phone Number
                        <span class="text-muted fw-normal">
                            (Optional)
                        </span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-telephone"></i>
                        </span>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="form-control"
                            value="<?= e($oldPhone ?? '') ?>"
                            placeholder="+92 300 1234567"
                            autocomplete="tel"
                            maxlength="30"
                        >

                    </div>

                </div>


                <!-- Password -->
                <div class="mb-3">

                    <label
                        for="password"
                        class="form-label fw-semibold"
                    >
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Create a strong password"
                            autocomplete="new-password"
                            minlength="8"
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
                        Password must contain at least 8 characters.
                    </div>

                </div>


                <!-- Password Strength -->
                <div class="mb-3">

                    <div class="password-strength">

                        <div
                            id="passwordStrengthBar"
                            class="password-strength-bar"
                        ></div>

                    </div>

                    <small
                        id="passwordStrengthText"
                        class="text-muted"
                    >
                        Password strength
                    </small>

                </div>


                <!-- Password Requirements -->
                <div class="mb-4">

                    <p class="small fw-semibold mb-2">
                        Password requirements:
                    </p>

                    <ul
                        class="password-requirements list-unstyled mb-0"
                    >

                        <li
                            id="lengthRequirement"
                            class="requirement-invalid"
                        >
                            <i class="bi bi-circle me-1"></i>
                            At least 8 characters
                        </li>

                        <li
                            id="letterRequirement"
                            class="requirement-invalid"
                        >
                            <i class="bi bi-circle me-1"></i>
                            Contains a letter
                        </li>

                        <li
                            id="numberRequirement"
                            class="requirement-invalid"
                        >
                            <i class="bi bi-circle me-1"></i>
                            Contains a number
                        </li>

                    </ul>

                </div>


                <!-- Confirm Password -->
                <div class="mb-4">

                    <label
                        for="password_confirmation"
                        class="form-label fw-semibold"
                    >
                        Confirm Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Repeat your password"
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="btn"
                            id="toggleConfirmPassword"
                            aria-label="Show confirmation password"
                            aria-pressed="false"
                        >

                            <i
                                class="bi bi-eye"
                                id="confirmPasswordIcon"
                            ></i>

                        </button>

                    </div>

                    <div
                        id="passwordMatchMessage"
                        class="small mt-2"
                    ></div>

                </div>


                <!-- Terms -->
                <div class="form-check mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="terms"
                        name="terms"
                        value="1"
                        required
                    >

                    <label
                        class="form-check-label small"
                        for="terms"
                    >
                        I agree to the
                        <a href="/terms" target="_blank">
                            Terms of Service
                        </a>
                        and
                        <a href="/privacy" target="_blank">
                            Privacy Policy
                        </a>.
                    </label>

                    <div class="invalid-feedback">
                        You must agree before creating an account.
                    </div>

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="btn btn-primary w-100 register-btn"
                    id="registerButton"
                >

                    <span id="registerButtonText">
                        Create Account
                    </span>

                    <span
                        id="registerSpinner"
                        class="spinner-border spinner-border-sm d-none ms-2"
                        aria-hidden="true"
                    ></span>

                </button>

            </form>


            <!-- Login -->
            <div class="text-center mt-4">

                <p class="mb-0 text-muted">

                    Already have an account?

                    <a
                        href="/client/login"
                        class="fw-semibold text-decoration-none"
                    >
                        Sign in
                    </a>

                </p>

            </div>


            <!-- Security -->
            <div class="text-center mt-4">

                <p class="security-note mb-0">

                    <i class="bi bi-shield-check me-1"></i>

                    Your account information is handled securely.

                </p>

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

    const form =
        document.getElementById("clientRegisterForm");

    const password =
        document.getElementById("password");

    const confirmPassword =
        document.getElementById("password_confirmation");

    const togglePassword =
        document.getElementById("togglePassword");

    const toggleConfirmPassword =
        document.getElementById("toggleConfirmPassword");

    const passwordIcon =
        document.getElementById("passwordIcon");

    const confirmPasswordIcon =
        document.getElementById("confirmPasswordIcon");

    const strengthBar =
        document.getElementById("passwordStrengthBar");

    const strengthText =
        document.getElementById("passwordStrengthText");

    const matchMessage =
        document.getElementById("passwordMatchMessage");

    const registerButton =
        document.getElementById("registerButton");

    const registerButtonText =
        document.getElementById("registerButtonText");

    const registerSpinner =
        document.getElementById("registerSpinner");


    /*
    |--------------------------------------------------------------------------
    | Password Visibility
    |--------------------------------------------------------------------------
    */

    function setupPasswordToggle(
        button,
        input,
        icon
    ) {

        if (!button) {
            return;
        }

        button.addEventListener(
            "click",
            function () {

                const isPassword =
                    input.type === "password";

                input.type =
                    isPassword
                        ? "text"
                        : "password";

                icon.className =
                    isPassword
                        ? "bi bi-eye-slash"
                        : "bi bi-eye";

                button.setAttribute(
                    "aria-label",
                    isPassword
                        ? "Hide password"
                        : "Show password"
                );

                button.setAttribute(
                    "aria-pressed",
                    isPassword
                        ? "true"
                        : "false"
                );

            }
        );
    }


    setupPasswordToggle(
        togglePassword,
        password,
        passwordIcon
    );

    setupPasswordToggle(
        toggleConfirmPassword,
        confirmPassword,
        confirmPasswordIcon
    );


    /*
    |--------------------------------------------------------------------------
    | Password Strength
    |--------------------------------------------------------------------------
    */

    function updatePasswordStrength() {

        const value = password.value;

        let score = 0;

        const hasLength =
            value.length >= 8;

        const hasLetter =
            /[A-Za-z]/.test(value);

        const hasNumber =
            /\d/.test(value);

        const hasSpecial =
            /[^A-Za-z0-9]/.test(value);

        if (hasLength) {
            score++;
        }

        if (hasLetter) {
            score++;
        }

        if (hasNumber) {
            score++;
        }

        if (hasSpecial) {
            score++;
        }


        /*
        | Update requirements
        */

        updateRequirement(
            "lengthRequirement",
            hasLength
        );

        updateRequirement(
            "letterRequirement",
            hasLetter
        );

        updateRequirement(
            "numberRequirement",
            hasNumber
        );


        /*
        | Update strength
        */

        if (value.length === 0) {

            strengthBar.style.width = "0%";

            strengthText.textContent =
                "Password strength";

            strengthText.className =
                "text-muted";

            return;
        }


        if (score <= 1) {

            strengthBar.style.width = "25%";

            strengthText.textContent =
                "Weak password";

        } else if (score === 2) {

            strengthBar.style.width = "50%";

            strengthText.textContent =
                "Fair password";

        } else if (score === 3) {

            strengthBar.style.width = "75%";

            strengthText.textContent =
                "Good password";

        } else {

            strengthBar.style.width = "100%";

            strengthText.textContent =
                "Strong password";
        }

        strengthText.className =
            score >= 3
                ? "text-success"
                : "text-muted";
    }


    /*
    |--------------------------------------------------------------------------
    | Requirement State
    |--------------------------------------------------------------------------
    */

    function updateRequirement(
        elementId,
        valid
    ) {

        const element =
            document.getElementById(elementId);

        if (!element) {
            return;
        }

        const icon =
            element.querySelector("i");

        if (valid) {

            element.classList.remove(
                "requirement-invalid"
            );

            element.classList.add(
                "requirement-valid"
            );

            icon.className =
                "bi bi-check-circle-fill me-1";

        } else {

            element.classList.remove(
                "requirement-valid"
            );

            element.classList.add(
                "requirement-invalid"
            );

            icon.className =
                "bi bi-circle me-1";
        }
    }


    password.addEventListener(
        "input",
        updatePasswordStrength
    );


    /*
    |--------------------------------------------------------------------------
    | Password Confirmation
    |--------------------------------------------------------------------------
    */

    function checkPasswordMatch() {

        if (confirmPassword.value === "") {

            matchMessage.textContent = "";

            confirmPassword.classList.remove(
                "is-valid",
                "is-invalid"
            );

            return;
        }

        if (
            password.value ===
            confirmPassword.value
        ) {

            confirmPassword.classList.remove(
                "is-invalid"
            );

            confirmPassword.classList.add(
                "is-valid"
            );

            matchMessage.textContent =
                "Passwords match.";

            matchMessage.className =
                "small mt-2 text-success";

        } else {

            confirmPassword.classList.remove(
                "is-valid"
            );

            confirmPassword.classList.add(
                "is-invalid"
            );

            matchMessage.textContent =
                "Passwords do not match.";

            matchMessage.className =
                "small mt-2 text-danger";
        }
    }


    confirmPassword.addEventListener(
        "input",
        checkPasswordMatch
    );

    password.addEventListener(
        "input",
        checkPasswordMatch
    );


    /*
    |--------------------------------------------------------------------------
    | Form Validation
    |--------------------------------------------------------------------------
    */

    if (form) {

        form.addEventListener(
            "submit",
            function (event) {

                checkPasswordMatch();

                if (
                    !form.checkValidity() ||
                    password.value !==
                    confirmPassword.value
                ) {

                    event.preventDefault();

                    event.stopPropagation();

                } else {

                    registerButton.disabled =
                        true;

                    registerButtonText.textContent =
                        "Creating account...";

                    registerSpinner.classList.remove(
                        "d-none"
                    );
                }

                form.classList.add(
                    "was-validated"
                );

            }
        );

    }

});

</script>

</body>

</html>