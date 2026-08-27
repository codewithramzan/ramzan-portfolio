<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= e($title ?? 'Client Dashboard') ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= asset('css/style.css') ?>"
    >

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="/client/dashboard"
        >
            Client Portal
        </a>

        <div>

            <span class="text-white me-3">
                <?= e(
                    Session::get(
                        'user_name',
                        'Client'
                    )
                ) ?>
            </span>

            <a
                href="/logout"
                class="btn btn-outline-light btn-sm"
            >
                Logout
            </a>

        </div>

    </div>

</nav>

<main class="container py-5">

    <?= $content ?? '' ?>

</main>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script src="<?= asset('js/app.js') ?>"></script>

</body>

</html>