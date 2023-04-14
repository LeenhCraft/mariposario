<?php headerApp('Template/header_dash', $data); ?>
<main class="app-content">
    <div class="card">
        <div class="card-header">
            <div class="tile">
                <?php
                if ($data['permisos']['perm_w'] == 1) {
                ?>
                    <button class="btn btn-primary ft-b" type="button" onclick="openModal();">
                        Agregar
                    </button>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="car-body">
            <div class="table-responsive text-nowrap mb-4">
                <table id="tb" class="table table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Doc</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="5" class="text-center">Sin registros</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlPersonal',$data);
}
footerApp('Template/footer_dash', $data);
?>