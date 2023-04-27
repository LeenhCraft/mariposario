<div class="modal fade" id="mdlCentinela" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmCentinela" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlCentinela-Title">Centinela</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idvisita" name="idvisita" value="">
                <div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">vis_cod</label>
                	<input type="text" class="form-control" id="vis_cod" name="vis_cod">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">idwebusuario</label>
                	<input type="text" class="form-control" id="idwebusuario" name="idwebusuario">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">vis_ip</label>
                	<input type="text" class="form-control" id="vis_ip" name="vis_ip">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">vis_agente</label>
                	<input type="text" class="form-control" id="vis_agente" name="vis_agente">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">vis_method</label>
                	<input type="text" class="form-control" id="vis_method" name="vis_method">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">vis_url</label>
                	<input type="text" class="form-control" id="vis_url" name="vis_url">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">vis_fechahora</label>
                	<input type="text" class="form-control" id="vis_fechahora" name="vis_fechahora">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>