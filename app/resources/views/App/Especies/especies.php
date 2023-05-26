<?php headerApp('Template/header_dash', $data); ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <h3 class="col-6 m-0">Lista de Mariposas</h3>
        </div>
        <hr>
    </div>
    <div class="card-body">
        <div class="filtros">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-group input-group-merge rounded-pill">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar por nombre comun o cientifico de la mariposa">
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex">
                    <div class="form-check m-0 my-auto me-3">
                        <label class="form-check-label">
                            Ver por:
                        </label>
                    </div>
                    <div class="form-check m-0 my-auto me-3">
                        <input name="default-radio-1" class="form-check-input" type="radio" value="familia" id="familia">
                        <label class="form-check-label" for="familia">
                            Familias
                        </label>
                    </div>
                    <div class="form-check m-0 my-auto me-3">
                        <input name="default-radio-1" class="form-check-input" type="radio" value="subfamilia" id="subfamilia">
                        <label class="form-check-label" for="subfamilia">
                            Subfamilias
                        </label>
                    </div>
                    <div class="form-check m-0 my-auto me-3">
                        <input name="default-radio-1" class="form-check-input" type="radio" value="genero" id="genero">
                        <label class="form-check-label" for="genero">
                            Generos
                        </label>
                    </div>
                    <div class="form-check m-0 my-auto">
                        <input name="default-radio-1" class="form-check-input" type="radio" value="especie" id="especie" checked>
                        <label class="form-check-label" for="especie">
                            Especie
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->
<div class="row mt-4 content-card-butter">
    <div class="col-6 col-md-2 mb-3 spinkit-content">
        <div class="card h-100" style="min-height:239px;">
            <div class="card-body h-100 d-flex flex-column justify-content-center align-items-center">
                <div class="spinkit-ln mb-3">
                    <div class="sk-chase sk-primary">
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                        <div class="sk-chase-dot"></div>
                    </div>
                </div>
                <h5>Cargando...</h5>
            </div>
        </div>
    </div>
</div>
<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) {
    getModal('mdlEspecies', $data);
}
footerApp('Template/footer_dash', $data);
?>