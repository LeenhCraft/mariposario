<div class="modal fade" id="mdlHistorial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmHistorial" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlHistorial-Title">Historial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idhistorial" name="idhistorial" value="">
                <div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">iddetallemodelo</label>
                	<input type="text" class="form-control" id="iddetallemodelo" name="iddetallemodelo">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">his_tiempo</label>
                	<input type="text" class="form-control" id="his_tiempo" name="his_tiempo">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">his_inicio</label>
                	<input type="text" class="form-control" id="his_inicio" name="his_inicio">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">his_fin</label>
                	<input type="text" class="form-control" id="his_fin" name="his_fin">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">his_index</label>
                	<input type="text" class="form-control" id="his_index" name="his_index">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">his_prediccion</label>
                	<input type="text" class="form-control" id="his_prediccion" name="his_prediccion">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">his_fecha</label>
                	<input type="text" class="form-control" id="his_fecha" name="his_fecha">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>