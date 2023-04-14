<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?php echo $data['titulo_web']; ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/img/logo.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/app/appfonts.css">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/css/app/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/css/app/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/css/app/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/css/app/custom.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/css/app/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/css/app/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/js/app/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/js/app/plugins/config.js"></script>

</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="divLoading" style="display: none;">
                    <div>
                        <img src="/img/loading.svg" alt="Loading">
                    </div>
                </div>
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="demo text-body fw-bolder logo"><?php echo $_ENV['APP_NAME']; ?></span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 d-none">Welcome to Sneat!</h4>
                        <p class="mb-4 d-none">Please sign-in to your account and start the adventure</p>
                        <form id="frmlogin" class="mb-3">
                            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                            <div class="mb-3">
                                <label for="email" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese su usuario" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <a href="#" class="d-none">
                                        <small>¿Ha olvidado tu contraseña?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="pass" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 d-none">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me">Recuerdame</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Ingresar</button>
                            </div>
                            <p><a class="a-web" href="/"><i class='bx bx-chevrons-right'></i>web</a></p>
                        </form>

                        <p class="text-center d-none">
                            <span>New on our platform?</span>
                            <a href="#">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <script>
        const base_url = "<?php echo base_url(); ?>";
    </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/js/app/plugins/jquery.min.js"></script>
    <script src="/js/app/plugins/popper.min.js"></script>
    <script src="/js/app/plugins/bootstrap.min.js"></script>

    <script src="/js/app/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/js/app/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="/js/app/plugins/main.js"></script>

    <script src="/js/app/plugins/sweetalert2.all.min.js"></script>
    <script>
        var divLoading = $(".divLoading");
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        function verpass(e, input) {
            let selector = "#" + input;
            let elem = $(selector);
            console.log(elem);

            if (elem.attr("type") == "password") {
                elem.attr("type", "text");
            } else {
                elem.attr("type", "password");
            }
        }
    </script>
    <?php
    if (isset($data['js']) && !empty($data['js'])) {
        for ($i = 0; $i < count($data['js']); $i++) {
            echo '<script src="' . base_url() . $data['js'][$i] . '"></script>';
        }
    }
    ?>

</body>

</html>