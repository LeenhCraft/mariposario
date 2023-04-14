<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centeredd modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header mb-4 border-bottom">
                <h5 class="modal-title" id="backDropModalTitle">Agregar Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs border-bottom" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-uno" aria-controls="navs-uno" aria-selected="true">
                                General
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link disabled" role="tab" data-bs-toggle="tab" data-bs-target="#navs-dos" aria-controls="navs-dos" aria-selected="false">
                                Web
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link disabled" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tres" aria-controls="navs-tres" aria-selected="false">
                                Descripción
                            </button>
                        </li>
                    </ul>
                    <form id="form" onsubmit="return save(this,event)" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="navs-uno" role="tabpanel">
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                                <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">

                                <div class="col-12 col-md-12 mb-3">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                        <label class="form-check-label" for="status">Activar/Desactivar</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="type_article">Tipo articulo:</label>
                                            <select class="form-select text-capitalize" id="type_article" name="type_article">
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="stock_number">Num Inventario:</label>
                                            <input type="text" class="form-control" id="stock_number" name="stock_number" placeholder="ABC123">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name">Nombre:</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <!-- <textarea name="description" id="description" cols="30" rows="10"></textarea> -->
                                            <div id="description"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-dos" role="tabpanel">
                                ...
                            </div>
                            <div class="tab-pane fade" id="navs-tres" role="tabpanel">
                                ...
                            </div>
                            <div class="modal-footer text-center">
                                <div class="col-12 text-center">
                                    <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>