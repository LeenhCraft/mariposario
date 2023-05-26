<?php headerApp('Template/header_dash', $data); ?>
<div class="row">
    <div class="col-12 col-lg-12 mb-4 order-0 d-none">
        <div class="card">
            <h3 class="card-header">Generar Datos de Entrenamiento</h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-4">
                        <label for="ruta" class="form-label">Ruta para Guardar los Datos de Entrenamiento</label>
                        <input type="text" class="form-control" placeholder="<?= base_url() ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-4">
                        <label for="nombre" class="form-label">Nombre para Guardar los Datos de Entrenamiento</label>
                        <input type="text" class="form-control" placeholder="datos-de-entrenamiento.npy">
                    </div>
                    <div class="col-3 mx-auto text-center mb-4">
                        <button class="btn btn-primary"><i class='bx bx-plus-medical me-2'></i>Generar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    </style>
    <div class="col-12">
        <div class="card">
            <h3 class="card-header">Generar Datos de Entrenamiento</h3>
            <div class="card-body">
                <div class="wrapper well">
                    <div class="desc-wrapper">
                        <div class="desc">
                            <div class="parte-1">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 mb-4">
                                        <label for="ruta" class="form-label">Ruta para Guardar los Datos de Entrenamiento</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><?= base_url() ?></span>
                                            <input type="text" class="form-control bg-transparent" placeholder="URL" id="ruta" name="ruta_datos_entrenamiento" value="<?= $data["ruta_datos_entrenamiento"] ?>" disabled>
                                            <button id="btnRtaEntre" class="input-group-text cursor-pointer"><i class="bx bx bxs-edit-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mb-4">
                                        <label for="nombre" class="form-label">Nombre para Guardar los Datos de Entrenamiento</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" class="form-control bg-transparent" id="nombre" name="nombre_datos_entrenamiento" placeholder="datos-de-entrenamiento.npy" value="<?= $data["nombre_datos_entrenamiento"] ?>" disabled>
                                            <button id="btnNomEntre" class="input-group-text cursor-pointer"><i class="bx bx bxs-edit-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-3 mx-auto text-center mb-4 btn-acction ">
                                        <button class="btn btn-primary generar-entrenamiento"><i class='bx bx-plus-medical me-2'></i>Generar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="parte-2">
                                <hr>
                                <h3>Imagenes</h3>
                                <div class="col-12 col-md-6 col-lg-6 mb-4">

                                    <label for="ruta" class="form-label">Ruta de la Carpeta con las Imagenes de Entrenamiento</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><?= base_url() ?></span>
                                        <input type="text" id="carpeta_img_entrenamiento" name="carpeta_img_entrenamiento" class="form-control bg-transparent" value="<?= $data["carpeta_img_entrenamiento"] ?? '' ?>" disabled>
                                        <button id="btnEditImg" type="button" class="input-group-text cursor-pointer text-primary" data-edit="false"><i class='bx bxs-edit-alt'></i></button>
                                    </div>


                                </div>
                            </div>
                            <hr>
                            <h3>Etiquetas</h3>

                            <div class="col-12 col-md-6 col-lg-6 mb-4">
                                <div class="row">
                                    <div class="col-10">
                                        <label class="form-control"><?= ($data["especies"] < 10) ? $data["especies"] . ' especie' : $data["especies"] . ' especies' ?>
                                        </label>
                                    </div>
                                    <div class="col-2">
                                        <button id="verEspecies" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class='bx bx-search me-2'></i>Ver</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="btn-2 text-center">
                                <button class="btn btn-primary generar-entrenamiento"><i class='bx bx-plus-medical me-2'></i>Generar</button>
                            </div>
                        </div>
                        <div class="modal fade" id="modalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Especies e Imagenes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="border-bottom py-2">
                                            <div class="row">
                                                <div class="col-6">Especie 1</div>
                                                <div class="col-6">80 Imagenes</div>
                                            </div>
                                        </div>
                                        <div class="border-bottom py-2">
                                            <div class="row">
                                                <div class="col-6">Especie 1</div>
                                                <div class="col-6">80 Imagenes</div>
                                            </div>
                                        </div>
                                        <div class="border-bottom py-2">
                                            <div class="row">
                                                <div class="col-12">Sin especies e imagenes</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 text-center more-info mx-auto cursor-pointer">
                <div class="more">Más opciones
                    <div class="glyphicon glyphicon-chevron-down"><i class='bx bxs-chevrons-down'></i></div>
                </div>
                <div class="less">Menos Opciones
                    <div class="glyphicon glyphicon-chevron-up"><i class='bx bxs-chevrons-up'></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php footerApp('Template/footer_dash', $data) ?>