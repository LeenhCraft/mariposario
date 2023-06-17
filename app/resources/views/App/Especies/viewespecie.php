<?php headerApp('Template/header_dash', $data); ?>
<div class="card mb-5 especie-view">
    <div class="card-header d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
        <div>
            <button class="btn btn-outline-primary" onclick="window.history.back();"><i class='bx bx-arrow-back me-2'></i>Regresar</button>
            <?php if ($data["permisos"]["perm_u"]) : ?>
                <button class="btn btn-primary btn-especie-edit">
                    <i class='bx bxs-edit-alt me-2'></i>Editar
                </button>
            <?php endif; ?>
        </div>
        <div class="action-btns">
            <?php if ($data["permisos"]["perm_u"]) : ?>
                <button class="btn btn-outline-info btn-especie-entre">
                    <i class='bx bxs-edit-alt me-2'></i>I. Entrenamiento
                </button>
            <?php endif; ?>
            <?php if ($data["permisos"]["perm_d"]) : ?>
                <button class="btn btn-outline-danger btn-especie-delete">
                    <i class='bx bxs-trash-alt me-2'></i>Eliminar
                </button>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" id="idespecie" name="idespecie" value="<?= $data["data"]["idespecie"] ?>">
            <div class="col-12 col-md-4">
                <img class="w-100" src="<?= !empty($data["data"]["es_imagen_url"]) ? base_url() . $data["data"]["es_imagen_url"] : base_url() . 'img/placeholder/img-placeholder-dark.jpg' ?>" alt="<?= $data["data"]["es_nombre_comun"] ?>">
            </div>
            <div class="col-12 col-md-8">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row mb-4">
                        <div class="fw-bold me-3">Nombre Comun:</div>
                        <div><?= $data["data"]["es_nombre_comun"] ?></div>
                    </div>
                    <div class="d-flex flex-row mb-4">
                        <div class="fw-bold me-3">Nombre Cientifico:</div>
                        <div><?= $data["data"]["es_nombre_cientifico"] ?></div>
                    </div>
                    <div class="d-flex flex-row mb-4">
                        <div class="fw-bold me-3">Taxonomia:</div>
                        <div><?= $data["data"]["idgenero"] ?></div>
                    </div>
                    <div class="d-flex flex-row mb-4">
                        <div class="fw-bold me-3">F. Registro:</div>
                        <div><?= date("d/m/Y", strtotime($data["data"]["es_date"])) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h3 class="text-center">Descripcion</h3>
                <div>
                    <?= $data["data"]["es_descripcion"] ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($data["permisos"]["perm_u"]) : ?>
    <div class="row especie-edit" style="display: none;">
        <div class="col-12">
            <div class="card">
                <div id="sticky-wrapper" class="sticky-wrapper" style="height: 87.1354px;">
                    <div class="card-header d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <div>
                            <button class="btn btn-outline-primary" onclick="window.history.back();"><i class='bx bx-arrow-back me-2'></i>Regresar</button>
                            <button class="btn btn-secondary btn-especie-cancel">
                                <i class='bx bx-x me-2'></i>Cancelar
                            </button>
                        </div>
                        <div class="action-btns">
                            <button class="btn btn-outline-info btn-especie-entre">
                                <i class='bx bxs-edit-alt me-2'></i>I. Entrenamiento
                            </button>
                            <button class="btn btn-outline-danger btn-especie-delete">
                                <i class='bx bxs-trash-alt me-2'></i>Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                <form onsubmit="return update(this,event)" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 text-center">
                                <div class="w-100 container-img mb-2">
                                    <input type="file" name="es_imagen_url" id="es_imagen_url" class="file" accept="image/*">
                                    <div class="dz-message img-edit fw-bold needsclick text-center my-0">
                                        Haga click aqui para cargar una imagen<br><span class="note needsclick">(Esta imagen es la <strong>referencia</strong> para la especie.)</span>
                                    </div>
                                </div>
                                <div id="navs-dos">
                                    <input type="hidden" id="eliminar_img" name="eliminar_img" value="0">
                                    <button id="btn-butter" type="button" class="btn btn-sm btn-danger" onclick="btn_butter()">Eliminar</button>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nombre Comun</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="es_nombre_comun" name="es_nombre_comun">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Nombre Cientifico</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="es_nombre_cientifico" name="es_nombre_cientifico">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6 col-md-4">
                                        <div class="mb-3">
                                            <label for="idfamilia" class="form-label">Familia</label>
                                            <select class="form-select" id="idfamilia">
                                                <option value="0">Sin información</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 idsubfamilia">
                                        <div class="mb-3">
                                            <label for="idsubfamilia" class="form-label">SubFamilia</label>
                                            <select class="form-select" id="idsubfamilia">
                                                <option value="0">Sin información</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 idgenero">
                                        <div class="mb-3">
                                            <label for="idgenero" class="form-label">Genero</label>
                                            <select class="form-select" id="idgenero" name="idgenero">
                                                <option value="0">Sin información</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <h3 class="text-center">Descripción</h3>
                                <div id="description"></div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class='bx bx-check me-2'></i>Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <?php //dep($data) 
            ?>
        </div>
    </div>

    <div class="row especie-entre" style="display: none;">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                    <div>
                        <button class="btn btn-outline-primary" onclick="window.history.back();"><i class='bx bx-arrow-back me-2'></i>Regresar</button>
                        <button class="btn btn-secondary btn-especie-cancel">
                            <i class='bx bx-x me-2'></i>Cancelar
                        </button>
                    </div>
                    <div class="action-btns">
                        <button class="btn btn-outline-info btn-especie-entre">
                            <i class='bx bxs-edit-alt me-2'></i>I. Entrenamiento
                        </button>
                        <button class="btn btn-outline-danger btn-especie-delete">
                            <i class='bx bxs-trash-alt me-2'></i>Eliminar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="idespecie" name="idespecie" value="<?= $data["data"]["idespecie"] ?>">
                        <div class="col-12 col-md-4">
                            <img class="w-100" src="<?= !empty($data["data"]["es_imagen_url"]) ? base_url() . $data["data"]["es_imagen_url"] : base_url() . 'img/placeholder/img-placeholder-dark.jpg' ?>" alt="<?= $data["data"]["es_nombre_comun"] ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row mb-4">
                                    <div class="fw-bold me-3">Nombre Comun:</div>
                                    <div><?= $data["data"]["es_nombre_comun"] ?></div>
                                </div>
                                <div class="d-flex flex-row mb-4">
                                    <div class="fw-bold me-3">Nombre Cientifico:</div>
                                    <div><?= $data["data"]["es_nombre_cientifico"] ?></div>
                                </div>
                                <div class="d-flex flex-row mb-4">
                                    <div class="fw-bold me-3">Taxonomia:</div>
                                    <div><?= $data["data"]["idgenero"] ?></div>
                                </div>
                                <div class="d-flex flex-row mb-4">
                                    <div class="fw-bold me-3">F. Registro:</div>
                                    <div><?= date("d/m/Y", strtotime($data["data"]["es_date"])) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <di class="card">
                <div class="card-header">
                    <h5>Imagenes para entrenamiento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <span>Total de Imagenes: <strong class="numimgentre">0</strong></span>
                        </div>
                        <div class="col-12 mb-4">
                            <form id="myDropzone" class="dropzone container-img" enctype="multipart/form-data">
                                <div class="dz-message fw-bold needsclick text-center">
                                    Haga click aqui para cargar una imagen
                                    <br>
                                    <span class="note needsclick">(Esta imagen es la <strong>referencia</strong> para la especie.)</span>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="row viewimgentre">

                            </div>
                        </div>
                    </div>
                </div>
            </di>
        </div>
    </div>
<?php endif; ?>

<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlEspecies', $data);
}
footerApp('Template/footer_dash', $data);
?>