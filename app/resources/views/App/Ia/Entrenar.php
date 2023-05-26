<?php headerApp('Template/header_dash', $data); ?>
<div class="card mb-4">
    <div class="card-header">
        <h3>Modelo Actual del Sistema</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 mb-4">
                <label for="ruta" class="form-label">modelo actual</label>
                <div class="row">
                    <div class="col-10">
                        <label class="form-control w-100 h-100"><?= $data["ruta_modelo"] ?></label>
                    </div>
                    <div class="col-2">
                        <button id="verModelos" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalModelos"><i class='bx bx-search me-2'></i>Ver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3>Entrenar Nuevo Modelo</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="ruta" class="form-label">Nombre del Nuevo Modelo</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="nombre_modelo" name="nombre_modelo" class="form-control" value="<?= $data["nombre_modelo"] ?? "" ?>" disabled>
                            <button id="editNameModel" type="button" class="input-group-text cursor-pointer text-primary" data-edit="false"><i class='bx bxs-edit-alt'></i></button>
                        </div>

                    </div>
                    <div class="col-6 col-md text-end">
                        <button id="btnEntrenar" class="btn btn-primary mt-4"><i class='bx bxs-graduation me-2'></i>Entrenar Modelo</button>
                    </div>
                </div>
            </div>
            <div class="col-12 my-4">
                <label><b>Lista de Datos de Entrenamiento</b></label>
                <div class="table-responsive text-nowrap p-0 m-0 mb-4">
                    <table id="tbl" class="table table-hover w-100" width="100%">
                        <thead>
                            <tr>
                                <th>a</th>
                                <th>Fecha</th>
                                <th>Ruta</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlEntrenamiento', $data);
}
footerApp('Template/footer_dash', $data)
?>