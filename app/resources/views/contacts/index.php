<?php require_once '../resources/views/inc/header.php'; ?>
<h1>listado de contactos</h1>
<form action="/contacts" method="get" class="form-inline">
    <div class="form-group my-3 w-75">
        <input name="search" type="text" class="w-100 form-control" placeholder="Escriba el nombre de un contacto">
    </div>
    <button type="submit" class="btn btn-primary ml-3 my-3">Buscar</button>
</form>
<a class="btn btn-success" href="/contacts/create">Crear contacto</a>
<p>Total de contáctos: <?= count($contacts) ?></p>
<ul>
    <?php foreach ($contacts['data'] as $contact) : ?>
        <li>
            <a href="/contacts/<?php echo $contact['id']; ?>">
                <?php echo $contact['name']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php

//indicar el nombre de la variable que contiene la paginación
$paginate = "contacts";

require_once '../resources/views/assets/pagination.php';

?>
<?php require_once '../resources/views/inc/footer.php'; ?>