<div class="modal fade" id="mdlEspecies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h5 class="modal-title" id="backDropModalTitle">Agregar Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-uno" aria-controls="navs-uno" aria-selected="true">
                                General
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-dos" aria-controls="navs-dos" aria-selected="false">
                                Imagen
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tres" aria-controls="navs-tres" aria-selected="false">
                                Información
                            </button>
                        </li>
                    </ul>
                    <form id="form" onsubmit="return save(this,event)" enctype="multipart/form-data">
                        <div class="tab-content p-0">
                            <div class="tab-pane pt-4 active show" id="navs-uno" role="tabpanel">
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                                <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="es_nombre_comun" class="form-label">Nombre Comun</label>
                                            <input type="text" class="form-control" id="es_nombre_comun" name="es_nombre_comun">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="es_nombre_cientifico" class="form-label">Nombre Cientifico</label>
                                            <input type="text" class="form-control" id="es_nombre_cientifico" name="es_nombre_cientifico">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="idfamilia" class="form-label">Familia</label>
                                                    <select class="form-select" id="idfamilia">
                                                        <option value="0">Sin información</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 idsubfamilia" style="display: none;">
                                                <div class="mb-3">
                                                    <label for="idsubfamilia" class="form-label">SubFamilia</label>
                                                    <select class="form-select" id="idsubfamilia">
                                                        <option value="0">Sin información</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 idgenero" style="display: none;">
                                                <div class="mb-3">
                                                    <label for="idgenero" class="form-label">Genero</label>
                                                    <select class="form-select" id="idgenero" name="idgenero">
                                                        <option value="0">Sin información</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-4 fade" id="navs-dos" role="tabpanel">
                                <div class="w-100 container-img">
                                    <input type="file" name="es_imagen_url" id="es_imagen_url" class="file" accept="image/*">
                                    <div class="dz-message fw-bold needsclick text-center">
                                        Haga click aqui para cargar una imagen
                                        <br>
                                        <span class="note needsclick">(Esta imagen es la <strong>referencia</strong> para la especie.)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-tres" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="description">
                                            leenhcraft.com
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center mt-4">
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