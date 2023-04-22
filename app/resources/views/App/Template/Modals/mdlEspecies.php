<div class="modal fade" id="mdlEspecies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmEspecies" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlEspecies-Title">Especies</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idespecie" name="idespecie" value="">
                <div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">idgenero</label>
                	<input type="text" class="form-control" id="idgenero" name="idgenero">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_nombre_cientifico</label>
                	<input type="text" class="form-control" id="es_nombre_cientifico" name="es_nombre_cientifico">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_nombre_comun</label>
                	<input type="text" class="form-control" id="es_nombre_comun" name="es_nombre_comun">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_habitad</label>
                	<input type="text" class="form-control" id="es_habitad" name="es_habitad">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_alimentacion</label>
                	<input type="text" class="form-control" id="es_alimentacion" name="es_alimentacion">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_plantas_hospederas</label>
                	<input type="text" class="form-control" id="es_plantas_hospederas" name="es_plantas_hospederas">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_tiempo_de_vida</label>
                	<input type="text" class="form-control" id="es_tiempo_de_vida" name="es_tiempo_de_vida">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_imagen_url</label>
                	<input type="text" class="form-control" id="es_imagen_url" name="es_imagen_url">
                </div>
				<div class="mb-3 col-lg-12 col-12">
                	<label class="form-label text-capitalize" for="basic-default-fullname">es_date</label>
                	<input type="text" class="form-control" id="es_date" name="es_date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>