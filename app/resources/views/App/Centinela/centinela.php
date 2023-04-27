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
            	<th>idvisita</th>
				<th>vis_cod</th>
				<th>idwebusuario</th>
				<th>vis_ip</th>
				<th>vis_agente</th>
				<th>vis_method</th>
				<th>vis_url</th>
				<th>vis_fechahora</th>
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
    getModal('mdlCentinela',$data);
}
footerApp('Template/footer_dash', $data);
?>