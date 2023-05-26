let tb;
$(document).ready(function () {
  tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/ordenes",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "num" },
      { data: "or_nombre" },
      { data: "or_descripcion" },
      { data: "or_date" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
  });
});
function save(ths, e) {
  // let men_nombre = $("#name").val();
  let form = $(ths).serialize();
  // if (men_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/ordenes/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlOrdenes").modal("hide");
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
function fntEdit(id) {
  resetForm();
  let ajaxUrl = base_url + "admin/ordenes/search";
  $(".modal-title").html("Agregar Ordenes");
  $("#btnText").html("Actualizar");
  $("#btnActionForm")
    .removeClass("btn-outline-primary")
    .addClass("btn-outline-info");
  $("#frmOrdenes").attr("onsubmit", "return update(this,event)");
  $("#mdlOrdenes").modal("show");
  //
  $.post(ajaxUrl, { idorden: id }, function (data) {
    if (data.status) {
      $("#idorden").val(data.data.idorden);
      $("#or_nombre").val(data.data.or_nombre);
      $("#or_descripcion").val(data.data.or_descripcion);
      $("#or_date").val(data.data.or_date);
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
function update(ths, e) {
  // let men_nombre = $("#name").val();
  let form = $(ths).serialize();
  // if (men_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/ordenes/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlOrdenes").modal("hide");
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
function fntDel(idp) {
  Swal.fire({
    title: "Eliminar Ordenes",
    text: "¿Realmente quiere eliminar Ordenes?",
    icon: "warning",
    showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/ordenes/delete";
      $.post(ajaxUrl, { idorden: idp }, function (data) {
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
  resetForm();
  $("#btnActionForm").removeClass("btn-outline-info");
  $("#btnActionForm").addClass("btn-outline-primary");
  $("#btnText").html("Guardar");
  $("#titleModal").html("Nuevo Ordenes");
  $("#idorden").val("");
  $("#frmOrdenes").attr("onsubmit", "return save(this,event)");
  $("#frmOrdenes").trigger("reset");
  $("#mdlOrdenes").modal("show");
}
function resetForm(ths) {
  $("#frmOrdenes").trigger("reset");
  $("#idorden").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar Ordenes");
}
