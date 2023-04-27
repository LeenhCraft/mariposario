<style>
    .dz-remove {
        display: block;
        text-align: center;
        padding: .375rem 0;
        font-size: .75rem
    }

    .dark-style .dz-preview {
        background: #2b2c40 !important;
        border: 0 solid #444564;
        border-radius: .375rem;
        box-shadow: 0 .125rem .5rem 0 rgba(0, 0, 0, .16)
    }

    @media(min-width: 576px) {
        .dark-style .dz-preview {
            display: inline-block;
            width: 11.25rem
        }

        .dark-style .dz-image {
            width: 10rem !important;
        }
    }

    .dark-style .dropzone {
        border: 2px dashed #444564
    }

    .dark-style .dz-preview .dz-remove {
        color: #a3a4cc;
        border-top: 1px solid #444564;
        border-bottom-right-radius: calc(0.375rem - 1px);
        border-bottom-left-radius: calc(0.375rem - 1px)
    }

    .dark-style .dz-remove:hover,
    .dark-style .dz-remove:focus {
        color: #a3a4cc;
        background: rgba(255, 255, 255, .8)
    }

    .dz-image {
        position: relative !important;
        padding: .625rem;
        height: 7.5rem !important;
        text-align: center;
        box-sizing: content-box
    }

    .dz-image>img,
    .dz-image .dz-nopreview {
        top: 50%;
        position: relative;
        transform: translateY(-50%) scale(1) !important;
        margin: 0 auto;
        display: block !important
    }

    .dz-image>img {
        max-height: 100%;
        max-width: 100%
    }

    .dz-nopreview {
        font-weight: 600;
        text-transform: uppercase;
        font-size: .6875rem
    }

    .dz-image img[src]~.dz-nopreview {
        display: none
    }

    .dropzone .dz-preview .dz-error-message {
        top: 180px !important;
        left: 0 !important;
        width: 11.25rem !important;
    }
</style>
<div class="modal fade" id="mdlEspecies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmEspecies" class="modal-content" onsubmit="return save(this,event)" enctype="multipart/form-data">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlEspecies-Title">Especies</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idespecie" name="idespecie" value="">
                <div class="row mb-3">
                    <div class="col-lg-4 col-12">
                        <label for="subordenes" class="form-label">Sub Ordenes</label>
                        <select id="subordenes" name="subordenes" class="form-select" onchange="loadFamilias('#subordenes')">
                            <option value="">Seleccione un valor</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="familias" class="form-label">Familias</label>
                        <select id="familias" name="familias" class="form-select">
                            <option value="">Seleccione un valor</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="generos" class="form-label">Generos</label>
                        <select id="generos" name="generos" class="form-select" id="idgenero" name="idgenero">
                            <option value="">Seleccione un valor</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-12">
                        <label class="form-label text-capitalize" for="basic-default-fullname">Nombre Cientifico</label>
                        <input type="text" class="form-control" id="es_nombre_cientifico" name="es_nombre_cientifico">
                    </div>
                    <div class="col-lg-6 col-12">
                        <label class="form-label text-capitalize" for="basic-default-fullname">Nombre Común</label>
                        <input type="text" class="form-control" id="es_nombre_comun" name="es_nombre_comun">
                    </div>
                </div>
                <div class="mb-3 col-lg-12 col-12 d-none">
                    <label class="form-label text-capitalize" for="basic-default-fullname">es_habitad</label>
                    <input type="text" class="form-control" id="es_habitad" name="es_habitad">
                </div>
                <div class="mb-3 col-lg-12 col-12 d-none">
                    <label class="form-label text-capitalize" for="basic-default-fullname">es_alimentacion</label>
                    <input type="text" class="form-control" id="es_alimentacion" name="es_alimentacion">
                </div>
                <div class="mb-3 col-lg-12 col-12 d-none">
                    <label class="form-label text-capitalize" for="basic-default-fullname">es_plantas_hospederas</label>
                    <input type="text" class="form-control" id="es_plantas_hospederas" name="es_plantas_hospederas">
                </div>
                <div class="mb-3 col-lg-12 col-12 d-none">
                    <label class="form-label text-capitalize" for="basic-default-fullname">es_tiempo_de_vida</label>
                    <input type="text" class="form-control" id="es_tiempo_de_vida" name="es_tiempo_de_vida">
                </div>
                <div class="mb-3 col-lg-12 col-12">
                    <label class="form-label text-capitalize" for="basic-default-fullname">es_imagen_url</label>
                    <input type="text" class="form-control" id="es_imagen_url" name="es_imagen_url">
                </div>
                <div class="mb-3 col-lg-12 col-12">
                    <div class="dropzone"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>