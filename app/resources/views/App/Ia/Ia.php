<?php headerApp('Template/header_dash', $data); ?>
<div class="row">
    <div class="col-lg-6 mb-4 order-0">
        <div class="card">
            <div class="card-body">
                <form onsubmit="return save(this,event)" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <h3>Subir Imagen</h3>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="photo" name="photo">
                        <button type="submit" class="btn btn-primary my-3">Identificar</button>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <h3>Resultados</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php footerApp('Template/footer_dash', $data) ?>