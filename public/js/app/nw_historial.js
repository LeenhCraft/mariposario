let tb;
$(document).ready(function () {
tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
    url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
    url: base_url + "admin/historial",
    method: "POST",
    dataSrc: "",
    },
    columns: [
        {data: "idhistorial"},
		{data: "iddetallemodelo"},
		{data: "his_tiempo"},
		{data: "his_inicio"},
		{data: "his_fin"},
		{data: "his_index"},
		{data: "his_prediccion"},
		{data: "his_fecha"},
		{data: "options"},

    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
    scrollX: true,
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
    let ajaxUrl = base_url + "admin/historial/save";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlHistorial").modal("hide");
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
    let ajaxUrl = base_url + "admin/historial/search";
    $(".modal-title").html("Agregar Historial");
    $("#btnText").html("Actualizar");
    $("#btnActionForm").removeClass("btn-outline-primary").addClass("btn-outline-info");
    $("#frmHistorial").attr("onsubmit", "return update(this,event)");
    $("#mdlHistorial").modal("show");
    //
    $.post(ajaxUrl, { idhistorial: id }, function (data) {
      if (data.status) {
        $("#idhistorial").val(data.data.idhistorial);
$("#iddetallemodelo").val(data.data.iddetallemodelo);
$("#his_tiempo").val(data.data.his_tiempo);
$("#his_inicio").val(data.data.his_inicio);
$("#his_fin").val(data.data.his_fin);
$("#his_index").val(data.data.his_index);
$("#his_prediccion").val(data.data.his_prediccion);
$("#his_fecha").val(data.data.his_fecha);

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
    let ajaxUrl = base_url + "admin/historial/update";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlHistorial").modal("hide");
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
      title: "Eliminar Historial",
      text: "¿Realmente quiere eliminar Historial?",
      icon: "warning",
      showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let ajaxUrl = base_url + "admin/historial/delete";
        $.post(ajaxUrl, { idhistorial: idp }, function (data) {
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
    $("#titleModal").html("Nuevo Historial");
    $("#idhistorial").val("");
    $("#frmHistorial").attr("onsubmit", "return save(this,event)");
    $("#frmHistorial").trigger("reset");
    $("#mdlHistorial").modal("show");
}
function resetForm(ths) {
    $("#frmHistorial").trigger("reset");
    $("#idhistorial").val("");
    $(ths).attr("onsubmit", "return save(this,event)");
    $("#btnText").html("Guardar");
    $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
    $(".modal-title").html("Agregar Historial");
}