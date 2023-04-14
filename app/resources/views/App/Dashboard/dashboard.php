<?php headerApp('Template/header_dash', $data); ?>
<div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Bienvenido</h5>
                        <h5 class="card-title text-primary"><?= getName($_SESSION['app_id'])['nombre'] ?>! 🎉</h5>
                        <p class="mb-4"><?= getName($_SESSION['app_id'])['rol'] ?></p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="/img/placeholder/woocommerce-placeholder-150x150.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1 d-none">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="/Assets/img/placeholder/woocommerce-placeholder-150x150.png" alt="chart success" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Profit</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="/Assets/img/placeholder/woocommerce-placeholder-150x150.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Sales</span>
                        <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SESSION['app_r'] == '1') {
?>
    <div class="row">
        <div class="col-12">
            <script>

            </script>
            <div class="card p-4">
                <div class="card-header">
                    Vistas
                </div>
                <div class="card-body p-1 overflow-auto">
                    <style>
                        #visitas {
                            min-width: 1200px;
                        }

                        ·visitas th,
                        td {
                            width: 100px;
                            word-wrap: break-word;
                        }

                        .id {
                            max-width: 46px;
                            word-wrap: break-word;
                        }
                    </style>
                    <table id="visitas" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="">Nº</th>
                                <th>Vis Cod</th>
                                <th>Id user</th>
                                <th>IP</th>
                                <th>Navegador</th>
                                <th>URL</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
}
dep($_SESSION);
?>
<?php footerApp('Template/footer_dash', $data) ?>