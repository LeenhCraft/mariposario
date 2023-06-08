<div class="modal fade" id="mdlConfiguracion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmConfiguracion" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlConfiguracion-Title">Configuracion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idconfig" name="idconfig" value="">
                <div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">nombre</label>
                	<input type="text" class="form-control" id="nombre" name="nombre">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">valor</label>
                    <textarea id="valor" name="valor" cols="30" rows="10" class="form-control d-none"></textarea>
                    <div id="containerr" style="height: 200px; border: 1px solid #d9dee3;" class="w-100"></div>
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">date</label>
                	<input type="text" class="form-control" id="date" name="date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>