<?php headerApp('Template/header_dash', $data); ?>

<div class="card">
    <div class="card-header">
        <h3>Historial de Identificaciones</h3>
    </div>
    <div class="card-body">
        <div class="total-historial">
            <h6 class="text-center m-0 p-0 mb-2">Total de Identificaciones</h6>
            <div class="text-center val">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4 content-card-butter">
            <div class="col-12 mb-3 spinkit-content">
                <div class="card h-100 border" style="min-height:239px;">
                    <div class="card-body h-100 d-flex flex-column justify-content-center align-items-center">
                        <div class="spinkit-ln mb-3">
                            <div class="sk-chase sk-primary">
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                            </div>
                        </div>
                        <h5 class="m-0 h-0">Cargando...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">

        <h6 class="m-0 p-0 mb-3">Paginación</h6>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link disabled" href="#">Anterior</a></li>
                <li class="page-item"><a class="page-link disabled" href="#">Siguiente</a></li>
            </ul>
        </nav>

    </div>
</div>
<script>
    var arrHistorial = <?= json_encode($data["list"]) ?>;
</script>

<div class="card" style="display: none;">
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
                    <th>idhistorial</th>
                    <th>iddetallemodelo</th>
                    <th>his_tiempo</th>
                    <th>his_inicio</th>
                    <th>his_fin</th>
                    <th>his_index</th>
                    <th>his_prediccion</th>
                    <th>his_fecha</th>
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
    getModal('mdlHistorial', $data);
}
footerApp('Template/footer_dash', $data);
?>