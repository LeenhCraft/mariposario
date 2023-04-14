<?php headerApp('Template/header_dash', $data); ?>
<div class="card">
    <div class="card-header">
        <h3>Limpiar</h3>
        <p>Esta sección vacia las tablas para volver a cargar data</p>
    </div>
    <div class="card-body">
        <div class="table-responsive w-75">
            <div class="px-4 mb-3">
                <?php
                if ($data['permisos']['perm_w'] == 1) :
                ?>
                    <button class="btn btn-outline-primary fw-bold" type="button" onclick="openModal();">
                        <i class='bx bx-plus-circle'></i> Tarea
                    </button>
                <?php
                endif;
                ?>
            </div>
            <table id="tb" class="table table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Opcion</th>
                        <th>Des.</th>
                        <th width=10></th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlTarea', $data);
}
footerApp('Template/footer_dash', $data);
?>