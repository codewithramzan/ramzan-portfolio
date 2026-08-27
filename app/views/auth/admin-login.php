<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-sm">

                <div class="card-body p-4">

                    <h2 class="fw-bold mb-1">
                        Admin Login
                    </h2>

                    <p class="text-muted mb-4">
                        Administrator access
                    </p>

                    <?php
                    $error = Session::getFlash('error');

                    if ($error):
                    ?>

                        <div class="alert alert-danger">
                            <?= e($error) ?>
                        </div>

                    <?php endif; ?>

                    <form
                        method="POST"
                        action="/admin/login"
                    >

                        <input
                            type="hidden"
                            name="_csrf"
                            value="<?= e(Csrf::token()) ?>"
                        >

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-dark w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>