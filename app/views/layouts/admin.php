<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= e($title ?? 'Admin Dashboard') ?>
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

<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <a
            class="navbar-brand fw-bold"
            href="/admin/dashboard"
        >
            Ramzan Admin
        </a>

        <div class="text-white">

            <span class="me-3">
                <?= e(
                    Session::get(
                        'user_name',
                        'Admin'
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

<div class="container-fluid">

    <div class="row">

        <aside class="col-md-3 col-lg-2 bg-light min-vh-100 p-3">

            <h6 class="text-muted">
                ADMINISTRATION
            </h6>

            <div class="list-group">

                <a
                    href="/admin/dashboard"
                    class="list-group-item list-group-item-action"
                >
                    Dashboard
                </a>

                <a
                    href="/admin/projects"
                    class="list-group-item list-group-item-action"
                >
                    Projects
                </a>

                <a
                    href="/admin/skills"
                    class="list-group-item list-group-item-action"
                >
                    Skills
                </a>

                <a
                    href="/admin/services"
                    class="list-group-item list-group-item-action"
                >
                    Services
                </a>

                <a
                    href="/admin/experience"
                    class="list-group-item list-group-item-action"
                >
                    Experience
                </a>

                <a
                    href="/admin/education"
                    class="list-group-item list-group-item-action"
                >
                    Education
                </a>

                <a
                    href="/admin/messages"
                    class="list-group-item list-group-item-action"
                >
                    Messages
                </a>

                <a
                    href="/admin/applications"
                    class="list-group-item list-group-item-action"
                >
                    Applications
                </a>

                <a
                    href="/admin/settings"
                    class="list-group-item list-group-item-action"
                >
                    Settings
                </a>

            </div>

        </aside>

        <main class="col-md-9 col-lg-10 p-4">

            <?= $content ?? ''?>

        </main>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script src="<?= asset('js/app.js') ?>"></script>

</body>

</html>