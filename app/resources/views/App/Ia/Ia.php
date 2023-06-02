<?php headerApp('Template/header_dash', $data); ?>
<div class="row">
    <div class="col-12 col-md-12 mb-4 order-0">
        <div class="card">
            <div class="card-header">
                <h3>Reconocimeinto Automatico</h3>
            </div>
            <div class="card-body">
                <form onsubmit="return save(this,event)" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <div class="mb-3 d-none">
                        <input class="form-control" type="file">
                    </div>
                    <div class="w-100 container-img">
                        <input type="file" id="photo" name="photo" class="file" accept="image/*">
                        <div class="dz-message fw-bold needsclick text-center">
                            Haga click aqui para cargar una imagen
                            <br>
                            <span class="note needsclick">(Esta imagen es la <strong>referencia</strong> para la especie.)</span>
                        </div>
                    </div>
                    <div class="btns d-flex justify-content-between my-4">
                        <button type="submit" class="btn btn-primary">Identificar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-12 mb-4 order-1 my-4 card-result" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h3>Resultados</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-auto">
                            <img class="result-img" src="" alt="resultado" width="450">
                        </div>
                        <div class="col-12 col-md-6">
                            <h5 class="m-0 p-0 mb-3">Nombre Cientifico:</h5>
                            <h4 class="m-0 ms-3 mb-3 result-name fw-bold"></h4>
                            <h5 class="m-0 p-0 mb-3">Nombre Comun:</h5>
                            <h4 class="m-0 ms-3 mb-3 result-name-2 fw-bold"></h4>
                            <h5 class="m-0 p-0 mb-3">Link:</h5>
                            <a href="#" class="result-link w-100 h4 ms-3 fw-bolf" target="_blank"><i class='bx bx-link-alt me-2'></i>Más información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php footerApp('Template/footer_dash', $data) ?>