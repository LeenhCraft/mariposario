    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form" class="modal-content" onsubmit="return save(this,event)">
                <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalmenusTitle">Editoriales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="description">Descripcion</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="form-group col-12 col-md-12">
                            <label for="status" class="text-capitalize">Estado:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>