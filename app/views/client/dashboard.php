<div class="mb-5">

    <h1 class="fw-bold">
        Welcome,
        <?= e(
            Session::get(
                'user_name',
                'Client'
            )
        ) ?>
    </h1>

    <p class="text-muted">
        From here you can contact Ramzan,
        apply for services and manage your requests.
    </p>

</div>

<div class="row g-4">

    <div class="col-md-6">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <h4>
                    Apply for a Service
                </h4>

                <p class="text-muted">
                    Submit your project requirements
                    and request a service.
                </p>

                <a
                    href="/client/applications/create"
                    class="btn btn-primary"
                >
                    Apply Now
                </a>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <h4>
                    Messages
                </h4>

                <p class="text-muted">
                    Send and receive messages regarding
                    your projects and applications.
                </p>

                <a
                    href="/client/messages"
                    class="btn btn-outline-primary"
                >
                    Open Messages
                </a>

            </div>

        </div>

    </div>

</div>