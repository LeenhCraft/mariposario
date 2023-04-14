<div class="modal fade" id="modalpermisos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo permisos</h5>
            </div>
            <div class="modal-body">
                <form id="permisos_form" name="permisos_form" class="form-horizontal">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <input type="hidden" id="idpermiso" name="idpermiso" value="">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="idrol">Roles</label>
                            <select name="idrol" id="idrol" class="form-control text-capitalize">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="idsubmenu">Submenus</label>
                            <select name="idsubmenu" id="idsubmenu" class="form-control text-capitalize">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                    <div class="tile-footer mt-4">
                        <button class="btn btn-primary ft-b" id="btnActionForm" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle ft-b"></i>
                            <span id="btnText">Guardar</span>
                        </button>
                        <button class="btn btn-danger ft-b text-capitalize ml-2" type="button" data-bs-dismiss="modal">
                            <i class="fa fa-lg fa-times-circle ft-b"></i>
                            <span class="text-capitalize">cerrar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Views -->
<div class="modal fade" id="mdView" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Permisos</h5>
            </div>
            <div class="modal-body">

                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <td>Idpermisos: </td>
                            <td id="idpermisos"></td>
                        </tr>
                        <tr>
                            <td>Idrol: </td>
                            <td id="idrol"></td>
                        </tr>
                        <tr>
                            <td>Idsubmenu: </td>
                            <td id="idsubmenu"></td>
                        </tr>
                        <tr>
                            <td>Perm_r: </td>
                            <td id="perm_r"></td>
                        </tr>
                        <tr>
                            <td>Perm_w: </td>
                            <td id="perm_w"></td>
                        </tr>
                        <tr>
                            <td>Perm_u: </td>
                            <td id="perm_u"></td>
                        </tr>
                        <tr>
                            <td>Perm_d: </td>
                            <td id="perm_d"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>