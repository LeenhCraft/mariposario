<?php headerApp('Template/header_dash', $data); ?>
<div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7">
                        <h5 class="card-title text-primary">Bienvenido</h5>
                        <h3 class="card-title text-primary"><?= getName($_SESSION['app_id'])['nombre'] ?>!!</h3>
                        <p class="mb-4"><?= getName($_SESSION['app_id'])['rol'] ?></p>
                    </div>
                    <div class="col-12 col-sm-5 text-center">
                        <img class="my-auto" src="/img/logo.png" alt="<?= $_ENV['APP_NAME'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-10 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h1>Identificar Mariposa</h1>

            </div>
            <div class="card-body">
                <a class="btn btn-primary" href="<?= base_url().'admin/ia' ?>">Empezar</a>
            </div>
        </div>
    </div>

    <?php if ($_ENV['APP_ENV'] === "local") : ?>
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/" target="_blank">
                        <img class="rounded-3" src="https://themeselection.com/wp-content/uploads/edd/2022/07/sneat-bootstrap-html-admin-dashboard-dark.png" alt="" height="140">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <p class="fw-bold">$_SESSION</p>
                </div>
                <div class="card-body">
                    <?php dep($_SESSION) ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <p class="fw-bold">$data</p>
                </div>
                <div class="card-body">
                    <?php dep($data) ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <p class="fw-bold">$data</p>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>HTML</dt>
                        <dd>lenguaje de marcado para la creación de páginas web</dd>
                        <dt>CSS</dt>
                        <dd>lenguaje de hojas de estilo para la presentación de páginas web</dd>
                        <dt>JavaScript</dt>
                        <dd>lenguaje de programación para la creación de interacciones y efectos en páginas web</dd>
                    </dl>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <p class="fw-bold">getName($_SESSION['app_id'])</p>
                </div>
                <div class="card-body">
                    <?php
                    dep(getName($_SESSION['app_id']));
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php footerApp('Template/footer_dash', $data) ?>