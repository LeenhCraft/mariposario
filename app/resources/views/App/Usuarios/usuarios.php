<?php headerApp('Template/header_dash', $data); ?>


<div class="card">
    <div class="card-header">
        <?php
        if ($data['permisos']['perm_w'] == 1) {
        ?>
            <button type="button" class="btn btn-primary" onclick="openModal()">
                Agregar
            </button>
        <?php
        }
        ?>
    </div>
    <div class="table-responsive text-nowrap mb-4">
        <table id="tb" class="table table-hover" width="100%">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlUsuarios', $data);
}
footerApp('Template/footer_dash', $data);
?>