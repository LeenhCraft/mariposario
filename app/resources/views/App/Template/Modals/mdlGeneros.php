<div class="modal fade" id="mdlGeneros" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmGeneros" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlGeneros-Title">Generos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idgenero" name="idgenero" value="">
                <div class="mb-3 col-lg-12 col-12">
                    <label class="form-label text-capitalize" for="basic-default-fullname">Subfamilias</label>
                    <select type="text" class="form-control" id="idsubfamilia" name="idsubfamilia">
                        <option value="0">Seleccione una subfamilia</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-12 col-12">
                    <label class="form-label text-capitalize" for="basic-default-fullname">Nombre para el genero</label>
                    <input type="text" class="form-control" id="gen_nombres" name="gen_nombres">
                </div>
                <div class="mb-3 col-lg-12 col-12">
                    <label class="form-label text-capitalize" for="basic-default-fullname">Descripcion</label>
                    <input type="text" class="form-control" id="gen_descripcion" name="gen_descripcion">
                </div>
                <div class="mb-3 col-lg-12 col-12 d-none">
                    <label class="form-label text-capitalize" for="basic-default-fullname">gen_date</label>
                    <input type="text" class="form-control" id="gen_date" name="gen_date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>