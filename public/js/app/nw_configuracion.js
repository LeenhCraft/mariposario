let tb;
$(document).ready(function () {
  tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/sistem",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "idconfig" },
      { data: "nombre" },
      { data: "valor" },
      { data: "date" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // establcer alto minimo 
    scrollY: "200px",
    scrollX: true,
    // scrollY: true,
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
  let ajaxUrl = base_url + "admin/sistem/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlConfiguracion").modal("hide");
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
  let ajaxUrl = base_url + "admin/sistem/search";
  $(".modal-title").html("Agregar Configuracion");
  $("#btnText").html("Actualizar");
  $("#btnActionForm")
    .removeClass("btn-outline-primary")
    .addClass("btn-outline-info");
  $("#frmConfiguracion").attr("onsubmit", "return update(this,event)");
  $("#mdlConfiguracion").modal("show");
  //
  $.post(ajaxUrl, { idconfig: id }, function (data) {
    if (data.status) {
      $("#idconfig").val(data.data.idconfig);
      $("#nombre").val(data.data.nombre);
      $("#valor").val(data.data.valor);
      $("#date").val(data.data.date);
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
  let ajaxUrl = base_url + "admin/sistem/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlConfiguracion").modal("hide");
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
    title: "Eliminar Configuracion",
    text: "¿Realmente quiere eliminar Configuracion?",
    icon: "warning",
    showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/sistem/delete";
      $.post(ajaxUrl, { idconfig: idp }, function (data) {
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
  $("#titleModal").html("Nuevo Configuracion");
  $("#idconfig").val("");
  $("#frmConfiguracion").attr("onsubmit", "return save(this,event)");
  $("#frmConfiguracion").trigger("reset");
  $("#mdlConfiguracion").modal("show");
}
function resetForm(ths) {
  $("#frmConfiguracion").trigger("reset");
  $("#idconfig").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar Configuracion");
}
