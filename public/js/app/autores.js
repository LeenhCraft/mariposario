let tb;
$(document).ready(function () {
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/autores",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "num", class: "text-left" },
      { data: "name", class: "font-weight-bold" },
      { data: "status", class: "text-center" },
      { data: "options", class: "text-end" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[1, "desc"]],
  });
});

function fntEdit(id) {
  let ajaxUrl = base_url + "admin/autores/search";
  $(".modal-form").html("Actualizar Tipo de articulo");
  $(".modal-header").removeClass("headerRegister");
  $(".modal-header").addClass("headerUpdate");
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#form").attr("onsubmit", "return update(this,event)");
  // $("#form").attr("id", "update_form");
  $("#modal").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    // console.log(data);
    if (data.status) {
      $("#id").val(data.data.idautor);
      $("#name").val(data.data.aut_nombre);
      $("#description").val(data.data.aut_descripcion);
      $("#status").val(data.data.aut_estado);
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
    title: "Eliminar submenus",
    text: "¿Realmente quiere eliminar submenus?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/autores/delete";
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

function openModal() {
  $(".modal-header").removeClass("headerUpdate");
  $(".modal-header").addClass("headerRegister");
  $("#btnActionForm").removeClass("btn-info");
  $("#btnActionForm").addClass("btn-primary");
  $("#btnText").html("Guardar");
  $(".modal-form").html("Tipos de Articulos");
  $("#id").val("");
  // $("#update_from").attr("id", "form");
  $("#form").attr("onsubmit", "return save(this,event)");
  $("#form").trigger("reset");
  $("#modal").modal("show");
  $("#name").focus();
}

function update(ths, e) {
  let sub_nombre = $("#name").val();

  let form = $(ths).serialize();
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/autores/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#modal").modal("hide");
      Swal.fire("Tipo de Articulo", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}

function save(ths, e) {
  let sub_nombre = $("#name").val();
  let form = $(ths).serialize();
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/autores/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      // $("#modal").modal("hide");
      $("#id").val("");
      $("#form").trigger("reset");
      Toast.fire({
        icon: "success",
        title: data.message,
      });
      // Swal.fire("Tipo de Articulo", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}
