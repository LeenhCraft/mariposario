<?php

namespace App\Controllers\Crud;

use App\Controllers\Controller;
use Nette\PhpGenerator\PhpFile;

class CrudCreateView extends Controller
{
    private $ruta;
    private $name;
    private $estructura;
    private $nombreTabla;
    private $form, $modal, $id;

    public function __construct($ruta, $name, $estructura, $nombreTabla)
    {
        $this->ruta = $ruta;
        $this->name = $name;
        $this->estructura = $estructura;
        $this->nombreTabla = $nombreTabla;
        $this->form = "frm$this->name";
        $this->id = $this->estructura[0];
        $this->modal = "mdl$this->name";
    }

    public function body()
    {
        $table = $this->table();
        $modal = "mdl$this->name";
        return <<<EOT
        <?php headerApp('Template/header_dash', \$data); ?>
        <div class="card">
            <div class="card-header">
                <?php
                if (\$data['permisos']['perm_w'] == 1) :
                ?>
                    <button class="btn btn-primary ft-b" type="button" onclick="openModal();">
                        <i class='bx bx-plus-circle'></i> Nuevo
                    </button>
                <?php
                endif;
                ?>
            </div>
            $table
        </div>
        <?php
        if (\$data['permisos']['perm_w'] == 1 || \$data['permisos']['perm_u'] == 1) {
            getModal('$modal',\$data);
        }
        footerApp('Template/footer_dash', \$data);
        ?>
        EOT;
    }

    private function table()
    {
        $form = "tbl";
        $th = '';
        foreach ($this->estructura as $key => $value) {
            $th .= "\t\t\t\t<th>$value</th>\n";
        }
        $th .= "\t\t\t\t<th>options</th>\n";
        $th = substr($th, 3);
        $th = substr($th, 0, -1);
        return <<<EOT
        <div class="table-responsive text-nowrap mb-4">
            <table id="$form" class="table table-hover" width="100%">
                <thead>
                    <tr>
                    $th
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        EOT;
    }

    public function modal()
    {
        $form = "frm$this->name";

        $input = $this->form();

        return <<<EOT
        <div class="modal fade" id="$this->modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <form id="$this->form" class="modal-content" onsubmit="return save(this,event)">
                    <input type="hidden" name="<?= \$data['tk']['name'] ?>" value="<?= \$data['tk']['key'][\$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= \$data['tk']['value'] ?>" value="<?= \$data['tk']['key'][\$data['tk']['value']] ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="$this->modal-Title">$this->name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="$this->id" name="$this->id" value="">
                        $input
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btnActionForm" type="submit" class="btn btn-outline-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        EOT;
    }

    private function form()
    {
        $input = '';
        foreach (array_slice($this->estructura, 1) as $field) {
            $input .= "\t\t\t\t<div class=\"mb-3 col-lg-12 col-12\">
                \t<label class=\"form-label text-capitalize\" for=\"basic-default-fullname\">$field</label>
                \t<input type=\"text\" class=\"form-control\" id=\"$field\" name=\"$field\">
                </div>\n";
        }
        $input = substr($input, 4);
        $input = substr($input, 0, -1);
        return $input;
    }

    public function js()
    {
        $form = "frm$this->name";
        $url = "admin/" . strtolower($this->name);

        $data = '';
        foreach ($this->estructura as $field) {
            $data .= "\t\t{data: \"$field\"},\n";
        }
        $data .= "\t\t{data: \"options\"},\n";
        $data = substr($data, 2);

        $save = $this->save();
        $edit = $this->edit();
        $update = $this->update();
        $delete = $this->delete();
        $openModal = $this->openModal();
        $resetForm = $this->resetForm();

        return <<<EOT
        let tb;
        $(document).ready(function () {
        tb = $("#tbl").dataTable({
            aProcessing: true,
            aServerSide: true,
            language: {
            url: base_url + "js/app/plugins/dataTable.Spanish.json",
            },
            ajax: {
            url: base_url + "$url",
            method: "POST",
            dataSrc: "",
            },
            columns: [
                $data
            ],
            resonsieve: "true",
            bDestroy: true,
            iDisplayLength: 10,
            // order: [[0, "desc"]],
            });
        });
        $save
        $edit
        $update
        $delete
        $openModal
        $resetForm
        EOT;
    }

    private function save()
    {
        $url = "admin/" . strtolower($this->name) . "/save";
        return <<<EOT
        function save(ths, e) {
            // let men_nombre = $("#name").val();
            let form = $(ths).serialize();
            // if (men_nombre == "") {
            //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
            //   return false;
            // }
            divLoading.css("display", "flex");
            let ajaxUrl = base_url + "$url";
            $.post(ajaxUrl, form, function (data) {
              if (data.status) {
                $("#$this->modal").modal("hide");
                resetForm();
                Swal.fire("Menu", data.message, "success");
                tb.api().ajax.reload();
              } else {
                Swal.fire("Error", data.message, "warning");
              }
              divLoading.css("display", "none");
            });
            return false;
        }
        EOT;
    }

    private function edit()
    {
        $url = "admin/" . strtolower($this->name) . "/search";
        $inputs = '';
        foreach ($this->estructura as $field) {
            $inputs .= "$(\"#$field\").val(data.data.$field);\n";
        }
        return <<<EOT
        function fntEdit(id) {
            resetForm();
            let ajaxUrl = base_url + "$url";
            $(".modal-title").html("Agregar $this->name");
            $("#btnText").html("Actualizar");
            $("#btnActionForm").removeClass("btn-outline-primary").addClass("btn-outline-info");
            $("#$this->form").attr("onsubmit", "return update(this,event)");
            $("#$this->modal").modal("show");
            //
            $.post(ajaxUrl, { $this->id: id }, function (data) {
              if (data.status) {
                $inputs
              } else {
                Swal.fire({
                  title: "Error",
                  text: data.message,
                  icon: "error",
                  confirmButtonText: "ok",
                });
              }
            });
        }
        EOT;
    }

    private function update()
    {
        $url = "admin/" . strtolower($this->name) . "/update";
        $inputs = '';
        foreach ($this->estructura as $field) {
            $inputs .= "$(\"#$field\").val(data.data.$field);\n";
        }
        return <<<EOT
        function update(ths, e) {
            // let men_nombre = $("#name").val();
            let form = $(ths).serialize();
            // if (men_nombre == "") {
            //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
            //   return false;
            // }
            divLoading.css("display", "flex");
            let ajaxUrl = base_url + "$url";
            $.post(ajaxUrl, form, function (data) {
              if (data.status) {
                $("#$this->modal").modal("hide");
                resetForm();
                Swal.fire("Menu", data.message, "success");
                tb.api().ajax.reload();
              } else {
                Swal.fire("Error", data.message, "warning");
              }
              divLoading.css("display", "none");
            });
            return false;
        }
        EOT;
    }

    private function delete()
    {
        $url = "admin/" . strtolower($this->name) . "/delete";
        return <<<EOT
        function fntDel(idp) {
            Swal.fire({
              title: "Eliminar $this->name",
              text: "¿Realmente quiere eliminar $this->name?",
              icon: "warning",
              showCancelButton: true,
            //   confirmButtonColor: "#3085d6",
            //   cancelButtonColor: "#d33",
              confirmButtonText: "Si, eliminar!",
              cancelButtonText: "No, cancelar!",
            }).then((result) => {
              if (result.isConfirmed) {
                let ajaxUrl = base_url + "$url";
                $.post(ajaxUrl, { $this->id: idp }, function (data) {
                  if (data.status) {
                    Swal.fire({
                      title: "Eliminado!",
                      text: data.message,
                      icon: "success",
                      confirmButtonText: "ok",
                    });
                    tb.DataTable().ajax.reload();
                  } else {
                    Swal.fire({
                      title: "Error",
                      text: data.message,
                      icon: "error",
                      confirmButtonColor: "#007065",
                      confirmButtonText: "ok",
                    });
                  }
                });
              }
            });
        }
        EOT;
    }

    private function openModal()
    {
        return <<<EOT
        function openModal() {
            resetForm();
            $("#btnActionForm").removeClass("btn-outline-info");
            $("#btnActionForm").addClass("btn-outline-primary");
            $("#btnText").html("Guardar");
            $("#titleModal").html("Nuevo $this->name");
            $("#$this->id").val("");
            $("#$this->form").attr("onsubmit", "return save(this,event)");
            $("#$this->form").trigger("reset");
            $("#$this->modal").modal("show");
        }
        EOT;
    }

    private function resetForm()
    {
        $id = $this->estructura[0];
        return <<<EOT
        function resetForm(ths) {
            $("#$this->form").trigger("reset");
            $("#$this->id").val("");
            $(ths).attr("onsubmit", "return save(this,event)");
            $("#btnText").html("Guardar");
            $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
            $(".modal-title").html("Agregar $this->name");
        }
        EOT;
    }
}
