<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?php echo $data['title']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <link rel="icon" type="image/png" href="img/logo.png">

    <meta name="Author" lang="es" content="leenhcraft.com">

    <link rel="stylesheet" href="/css/plugins/bootstrap.css">
    <link rel="stylesheet" href="/css/plugins/font.min.css">
    <link rel="stylesheet" href="/css/plugins/sweetalert2.min.css">

    <link rel="stylesheet" href="/css/web/animate.css">
    <link rel="stylesheet" href="/css/web/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/web/all.css">
    <link rel="stylesheet" href="/css/web/flaticon.css">
    <link rel="stylesheet" href="/css/web/themify-icons.css">
    <link rel="stylesheet" href="/css/web/magnific-popup.css">
    <link rel="stylesheet" href="/css/web/slick.css">
    <link rel="stylesheet" href="/css/web/style.css">
    <link rel="stylesheet" href="/css/custom.css">

    <?php
    if (isset($data['css']) && !empty($data['css'])) {
        for ($i = 0; $i < count($data['css']); $i++) {
            echo '<link rel="stylesheet" type="text/css" href="' . $data['css'][$i] . '">';
        }
    }
    ?>

</head>

<body>
    <div id="divLoading" style="display: none;">
        <div>
            <img src="/img/loading.svg" alt="Loading">
        </div>
    </div>

    <?php include_once __DIR__ . '/navbar_web.php' ?>