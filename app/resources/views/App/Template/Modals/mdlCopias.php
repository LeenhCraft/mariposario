<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="backDropModalTitle">Agregar Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <div class="my-2">
                    <button class="btn btn-success" type="button" onclick="resetForm('#form')"><i class='bx bxs-brush'></i> Limpiar</button>
                </div>
                <form id="form" onsubmit="return save(this,event)" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="idlibro">Libro</label>
                                <select name="idlibro" id="idlibro" class="form-select">
                                    <option value="">seleccione</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-3">
                                <label for="name">Codigo interno:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre o titulo del libro">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                        </div>
                    </div>
                    <div class="my-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>