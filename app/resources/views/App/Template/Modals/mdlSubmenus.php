<div class="modal fade" id="modalsubmenus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="submenus_form" class="modal-content" onsubmit="return save(this,event)">
            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
            <div class="modal-header">
                <h5 class="modal-title modal-form">Sub Menus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 div_id d-none">
                        <label for="idv">Id</label>
                        <input type="text" class="form-control" id="idv" name="idv" disabled>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="idmenu">Menu</label>
                        <select class="form-select text-capitalize" id="idmenu" name="idmenu">
                            <option value="0">Seleccione</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12">
                        <label for="name">Sub Menu</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="icon">Icono</label>
                        <input type="text" class="form-control" id="icon" name="icon">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-12 col-12">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12">
                        <label for="controller">Controlador</label>
                        <input type="text" class="form-control" id="controller" name="controller">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="method">Metodo</label>
                        <input type="text" class="form-control" id="method" name="method">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12">
                        <label for="order">Orden</label>
                        <input type="number" class="form-control" id="order" name="order">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="visible">Visible</label>
                        <select class="form-select" id="visible" name="visible">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 div_id">
                        <label for="fecha">F. Creación</label>
                        <input type="text" class="form-control" id="fecha" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnText" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Views -->
<div class="modal fade" id="mdView" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Submenus</h5>
            </div>
            <div class="modal-body">

                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <td>Idsubmenu: </td>
                            <td id="idsubmenu"></td>
                        </tr>
                        <tr>
                            <td>Idmenu: </td>
                            <td id="idmenuu"></td>
                        </tr>
                        <tr>
                            <td>Sub_nombre: </td>
                            <td id="sub_nombre"></td>
                        </tr>
                        <tr>
                            <td>Sub_url: </td>
                            <td id="sub_url"></td>
                        </tr>
                        <tr>
                            <td>Sub_controlador: </td>
                            <td id="sub_controlador"></td>
                        </tr>
                        <tr>
                            <td>Sub_icono: </td>
                            <td id="sub_icono"></td>
                        </tr>
                        <tr>
                            <td>Sub_orden: </td>
                            <td id="sub_orden"></td>
                        </tr>
                        <tr>
                            <td>Sub_visible: </td>
                            <td id="sub_visible"></td>
                        </tr>
                        <tr>
                            <td>Sub_fecha: </td>
                            <td id="sub_fecha"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Model Edit -->