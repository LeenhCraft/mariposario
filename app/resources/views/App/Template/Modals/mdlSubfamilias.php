<div class="modal fade" id="mdlSubfamilias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmSubfamilias" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlSubfamilias-Title">Subfamilias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idsubfamilia" name="idsubfamilia" value="">
                <div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">Familia</label>
                    <select name="idfamilia" id="idfamilia" class="form-control">
                        <option value="0">Seleccione</option>
                    </select>
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">Nombre para la subfamilia</label>
                	<input type="text" class="form-control" id="sub_nombre" name="sub_nombre">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">Descripcion</label>
                	<input type="text" class="form-control" id="sub_descripcion" name="sub_descripcion">
                </div>
				<div class="mb-3 col-lg-12 col-12 d-none">
                	<label class="form-label text-capitalize" for="basic-default-fullname">sub_date</label>
                	<input type="text" class="form-control" id="sub_date" name="sub_date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>