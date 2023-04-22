<?php headerApp('Template/header_dash', $data); ?>
<div class="card">
    <div class="card-header">
        <?php
        if ($data['permisos']['perm_w'] == 1) :
        ?>
            <button class="btn btn-primary ft-b" type="button" onclick="openModal();">
                <i class='bx bx-plus-circle'></i> Nuevo
            </button>
        <?php
        endif;
        ?>
    </div>
    <div class="table-responsive text-nowrap mb-4">
        <table id="tbl" class="table table-hover" width="100%">
            <thead>
                <tr>
                    <th>idespecie</th>
                    <th>idgenero</th>
                    <th>es_nombre_cientifico</th>
                    <th>es_nombre_comun</th>
                    <th>es_habitad</th>
                    <th>es_alimentacion</th>
                    <th>es_plantas_hospederas</th>
                    <th>es_tiempo_de_vida</th>
                    <th>es_imagen_url</th>
                    <th>es_date</th>
                    <th>options</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlEspecies', $data);
}
footerApp('Template/footer_dash', $data);
?>