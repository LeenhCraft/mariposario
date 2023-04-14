let tb;
$(document).ready(function () {
  $.fn.modal.Constructor.prototype._initializeFocusTrap = function () {
    return {
      activate: function () {},
      deactivate: function () {},
    };
  };
  initSample();
  $("#type_article").select2({
    dropdownParent: $("#modal"),
  });
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/articulos",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "num", class: "text-left" },
      { data: "name", class: "text-left" },
      { data: "type", class: "text-left" },
      { data: "status", class: "text-center" },
      { data: "options", class: "text-end" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[1, "desc"]],
  });
});

function openModal() {
  lstTipos();
  resetForm();
  $("#form").attr("onsubmit", "return save(this,event)");
  $("#modal").modal("show");
}

function validarImg(ths, event) {
  let view = $(".mostrarimagen");
  let file = $(ths)[0].files[0];
  var tmppath = URL.createObjectURL(event.target.files[0]);
  view
    .html('<img width="140px" src="' + tmppath + '" alt="" id="viewimg">')
    .show("fast");
}

function save(ths, e) {
  let sub_nombre = $("#name").val();
  // let form = $(ths).serialize();
  // let form = $(ths);
  let dat = new FormData(ths);
  let editor = CKEDITOR.instances.description.getData();
  dat.append("description", editor);

  // if (sub_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para el submenu.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/articulos/save";
  // $.post(ajaxUrl, dat, function (data) {
  //   if (data.status) {
  // $("#modal").modal("hide");
  // Swal.fire("submenus", data.message, "success");
  // tb.api().ajax.reload();
  //   } else {
  //     Swal.fire("Error", data.message, "warning");
  //   }
  //   divLoading.css("display", "none");
  // });
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        resetForm();
        Toast.fire({
          icon: "success",
          title: data.message,
        });
        tb.api().ajax.reload();
      } else {
        Swal.fire("Error", data.message, "warning");
      }
      divLoading.css("display", "none");
    },
    error: function (error) {
      console.log(error);
    },
  });
  return false;
}

function update(ths, e) {
  let sub_nombre = $("#name").val();
  let form = new FormData(ths);
  form.append("description", CKEDITOR.instances.description.getData());
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para el submenu.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/articulos/update";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: form,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        $("#modal").modal("hide");
        Swal.fire("articulo", data.message, "success");
        tb.api().ajax.reload();
      } else {
        Swal.fire("Error", data.message, "warning");
      }
      divLoading.css("display", "none");
    },
    error: function (error) {
      console.log(error);
    },
  });
  return false;
}

function fntEdit(id) {
  lstTipos();
  resetForm();
  let ajaxUrl = base_url + "admin/articulos/search";
  $(".modal-title").html("Actualizar articulo");
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#form").attr("onsubmit", "return update(this,event)");
  // $("#form").attr("id", "update_form");
  $("#modal").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    if (data.status) {
      // console.log(data);
      $("#id").val(data.data.idarticulo);
      $("#type_article").val(data.data.idtipo);
      $("#name").val(data.data.art_nombre);
      // $("#status").val(data.data.art_estado);
      $("#status")
        .prop("checked", data.data.art_estado == 1)
        .trigger("change");
      $("#stock_number").val(data.data.art_num_inventario);
      // $("#stock").html(data.data.sub_icono);
      // $("#publish").html(data.data.sub_visible);
      // $("#description").val(data.data.art_descripcion);
      window.editor.setData(data.data.art_descripcion);
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

function fntDel(idp) {
  Swal.fire({
    title: "Eliminar articulo",
    text: "¿Realmente quiere eliminar el articulo?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/articulos/delete";
      $.post(ajaxUrl, { id: idp }, function (data) {
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

function lstTipos() {
  let ajaxUrl = base_url + "admin/articulos/tipos";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#type_article").empty();
      $.each(data.data, function (index, value) {
        $("#type_article").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
}

function resetForm(ths) {
  $("#form").trigger("reset");
  $("#id").val("");
  CKEDITOR.instances.description.setData();
  $(".mostrarimagen").html("").hide("fast");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-primary");
  $(".modal-title").html("Agregar articulo");
}
