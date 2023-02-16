<?php require_once '../resources/views/inc/header.php'; ?>
<h1 class="mb-3">Detalle del Contácto</h1>
<a href="/contacts" class="btn btn-outline-primary mb-3">Volver</a>
<a href="/contacts/<?php echo $contact['id'] ?>/edit" class="btn btn-outline-warning mb-3">Editar</a>
<div class="form-group row">
    <label class="col-2 font-weight-bold text-left">Nombre: </label>
    <label class="col-10 text-capitalize"><?php echo $contact['name']; ?></label>
</div>
<div class="form-group row">
    <label class="col-2 font-weight-bold text-left">Email: </label>
    <label class="col-10 text-capitalize"><?php echo $contact['email']; ?></label>
</div>
<div class="form-group row">
    <label class="col-2 font-weight-bold text-left">Teléfono: </label>
    <label class="col-10 text-capitalize"><?php echo $contact['phone']; ?></label>
</div>
<form action="/contacts/<?= $contact['id'] ?>/delete" method="post">
    <button type="submit" class="btn btn-danger my-3">Eliminar</button>
</form>
<?php require_once '../resources/views/inc/footer.php'; ?>