<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centeredd modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="backDropModalTitle">Agregar Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <div class="my-2">
                    <button class="btn btn-success" type="button" onclick="resetForm('#form')"><i class='bx bxs-brush'></i> Limpiar</button>
                </div>
                <div class="nav-align-top">
                    <ul class="nav nav-tabs border-bottom" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-uno" aria-controls="navs-uno" aria-selected="true">
                                General
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-dos" aria-controls="navs-dos" aria-selected="false">
                                Web
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tres" aria-controls="navs-tres" aria-selected="false">
                                Descripción
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
                                    <div class="col-auto">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <label class="form-check-label" for="status">Activar/Desactivar</label>
                                        </div>
                                    </div>
                                    <div class="col-auto d-none">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="unique" name="unique" onchange="alert()" checked>
                                            <label class="form-check-label" for="unique">Copia única</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="idarticulo">Articulo:</label>
                                            <select name="idarticulo" id="idarticulo" class="form-select">
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="idautor">Autor:</label>
                                            <select class="form-select text-capitalize" id="idautor" name="idautor">
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="ideditorial">Editorial:</label>
                                            <select class="form-select text-capitalize" id="ideditorial" name="ideditorial">
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="name">Nombre/Titulo:</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre o titulo del libro" onload="crearSlug(this.value)" onkeyup="crearSlug(this.value)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <div class="form-group mb3">
                                            <label for="date_publish">Fecha Publicación:</label>
                                            <input id="date_publish" name="date_publish" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="form-group mb3">
                                            <label for="pages">Num Paginas:</label>
                                            <input id="pages" name="pages" type="number" class="form-control" min="1" pattern="^[0-9]+">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane pt-4 fade" id="navs-dos" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="publish" name="publish">
                                                <label class="form-check-label" for="publish">Publicar en la web</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="slug">Slug/URL:</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="slug-rul"><?= base_url() . 'libro/' ?></span>
                                                <input type="text" class="form-control" placeholder="URL" id="slug" name="slug" aria-describedby="slug-rul" readonly="readonly">
                                                <span class="input-group-text p-0">
                                                    <button type="button" class="btn py-2 px-3" onclick="editSlug(this)">
                                                        <i class="bx bxs-pencil i_var"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Imagen del articulo</label>
                                        <input type="file" class="form-control" name="photo" id="photo" onchange="validarImg(this,event)">
                                        <div class="mt-3 mostrarimagen" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-tres" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="description">
                                        </div>
                                        <!-- <textarea name="description" id="description" cols="30" rows="10"></textarea> -->
                                    </div>
                                </div>
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