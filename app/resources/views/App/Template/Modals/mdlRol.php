<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="person_form" name="form" class="form-horizontal" onsubmit="return save(this,event)">
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="form-group col-12 col-md-4 mt-3 mt-md-0">
                            <label for="code">Code:</label>
                            <input id="code" name="code" type="code" class="form-control" placeholder="/">
                        </div>
                        <div class="form-group col-12 col-md-8">
                            <label for="name">Nombre:</label>
                            <input id="name" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-12 col-md-6">
                            <label for="description" class="text-capitalize">Descripcion:</label>
                            <input id="description" name="description" type="text" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="status" class="text-capitalize">Estado:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary ft-b text-capitalize" type="button" data-bs-dismiss="modal">
                        <i class="fa fa-lg fa-times-circle">
                        </i>
                        <span class="text-capitalize">cerrar</span>
                    </button>
                    <button id="btnActionForm" class="btn btn-primary ft-b" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        <span id="btnText">Guardar</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>