<?php headerApp('Template/header_dash', $data); ?>
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Maestras /</span> Crud
</h4>
<div class="row">
    <div class="col-12 col-lg-10">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Formulario para la creación</h5>
                <small class="text-muted float-end"><i class='bx bxs-cog'></i> Crear una vista y su CRUD</small>
            </div>
            <div class="card-body">
                <form id="formCrud" name="formCrud" onsubmit="return save(this,Event)">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="controller">Controlador</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bx-right-arrow-alt'></i></span>
                                <input type="text" class="form-control" id="controller" name="controller" placeholder="Ejemplo">
                            </div>
                            <div class="form-text">No coloque la extension (.php) junto al nombre. Ejemplo: Articulo</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="table">Tabla</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bx-right-arrow-alt'></i></span>
                                <input type="text" id="table" name="table" class="form-control" placeholder="Table">
                            </div>
                            <div class="form-text">Nombre de la tabla en la base de datos.</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="query">Sql</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bx-right-arrow-alt'></i></span>
                                <textarea id="query" name="query" class="form-control" cols="50" rows="6" placeholder="SELECT * FROM test;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-10 ms-auto">
                            <div class="col-md">
                                <small class="text-light fw-semibold d-block">Acciones adicionales</small>
                                <div class="text-capitalize">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="checkbox" id="execute" name="execute" value="1">
                                        <label class="form-check-label" for="execute">ejecutar</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="create_controller" name="create_controller">
                                        <label class="form-check-label" for="create_controller">Controlador</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="create_model" name="create_model">
                                        <label class="form-check-label" for="create_model">Modelo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="create_view" name="create_view">
                                        <label class="form-check-label" for="create_view">Vista</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="create_js" name="create_js">
                                        <label class="form-check-label" for="create_js">Js</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 response_form">
                        <div class="col-12 col-sm-10 ms-auto">
                            <div class="alert alert-warning alert-dismissible" role="alert" style="display: none;">
                                <div class="alert-warning-body">
                                    Advertencias
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                            <div class="alert alert-success alert-dismissible" role="alert" style="display: none;">
                                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Excelente :)</h6>
                                <p class="mb-0 alert-success-body">success</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Error!!</h6>
                                <p class="mb-0">Aww yeah, you successfully read alert message.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"><i class='bx bxs-cog me-2'></i>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-none d-md-block col-lg-2">
        <div class="card h-100">
            <div class="card-body"></div>
        </div>
    </div>
</div>
<?php footerApp('Template/footer_dash', $data) ?>