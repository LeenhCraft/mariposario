<?php
$url = $_GET;
?>

<nav class="navbar navbar-light">
    <ul class="mx-md-auto">
        <p class="font-weight-500 py-3">General</p>
        <li class="p-2 active">
            <a href="/me"><i class="mr-3 fa fa-user" aria-hidden="true"></i> Mi perfil</a>
        </li>
        <li class="p-2">
            <a href="/me/forgot-password"><i class="mr-3 fa fa-user" aria-hidden="true"></i> Cambiar contraseña</a>
        </li>
        <p class="font-weight-500 py-3">Animes</p>
        <li class="p-2">
            <a href="/perfil/mirando"><i class="mr-3 fa fa-eye" aria-hidden="true"></i> Mirando</a>
        </li>
        <li class="p-2">
            <a href="/perfil/vistos"><i class="mr-3 fa fa-check-circle" aria-hidden="true"></i> Vistos</a>
        </li>
        <li class="p-2">
            <a href="/perfil/pendientes"><i class="mr-3 fa fa-pause-circle" aria-hidden="true"></i> Por ver</a>
        </li>
        <p class="font-weight-500 py-3">Misc</p>
        <li class="p-2">
            <a href="/perfil/editar"><i class="mr-3 fa fa-wrench" aria-hidden="true"></i> Editar perfil</a>
        </li>
    </ul>
</nav>