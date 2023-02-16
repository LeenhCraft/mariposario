<?php require_once '../resources/views/inc/header.php'; ?>
<h1>Actualizar contácto</h1>
<form action="/contacts/<?php echo $contact['id'] ?>" method="post">
    <div class="form-group">
        <label for="name" class="form-label font-weight-bold">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo $contact['name'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="email" class="form-label font-weight-bold">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $contact['email'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="phone" class="form-label font-weight-bold">Teléfono:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $contact['phone'] ?>" class="form-control">
    </div>
    <button type="submit" class="btn btn-success my-3">Actualizar</button>
</form>
<?php require_once '../resources/views/inc/footer.php'; ?>