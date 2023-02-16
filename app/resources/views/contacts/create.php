<?php require_once '../resources/views/inc/header.php'; ?>
    <h1>Crear contácto</h1>
    <form action="/contacts" method="post">
        <div class="form-group">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div>
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary my-3">Guardar</button>
    </form>
<?php require_once '../resources/views/inc/footer.php'; ?>