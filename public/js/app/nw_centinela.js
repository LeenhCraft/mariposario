let tb;
$(document).ready(function () {
tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
    url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
    url: base_url + "admin/centinela",
    method: "POST",
    dataSrc: "",
    },
    columns: [
        {data: "idvisita"},
		{data: "vis_cod"},
		{data: "idwebusuario"},
		{data: "vis_ip"},
		{data: "vis_agente"},
		{data: "vis_method"},
		{data: "vis_url"},
		{data: "vis_fechahora"},
		{data: "options"},

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
    let ajaxUrl = base_url + "admin/centinela/save";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlCentinela").modal("hide");
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
    let ajaxUrl = base_url + "admin/centinela/search";
    $(".modal-title").html("Agregar Centinela");
    $("#btnText").html("Actualizar");
    $("#btnActionForm").removeClass("btn-outline-primary").addClass("btn-outline-info");
    $("#frmCentinela").attr("onsubmit", "return update(this,event)");
    $("#mdlCentinela").modal("show");
    //
    $.post(ajaxUrl, { idvisita: id }, function (data) {
      if (data.status) {
        $("#idvisita").val(data.data.idvisita);
$("#vis_cod").val(data.data.vis_cod);
$("#idwebusuario").val(data.data.idwebusuario);
$("#vis_ip").val(data.data.vis_ip);
$("#vis_agente").val(data.data.vis_agente);
$("#vis_method").val(data.data.vis_method);
$("#vis_url").val(data.data.vis_url);
$("#vis_fechahora").val(data.data.vis_fechahora);

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
    let ajaxUrl = base_url + "admin/centinela/update";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlCentinela").modal("hide");
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
      title: "Eliminar Centinela",
      text: "¿Realmente quiere eliminar Centinela?",
      icon: "warning",
      showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let ajaxUrl = base_url + "admin/centinela/delete";
        $.post(ajaxUrl, { idvisita: idp }, function (data) {
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
    $("#titleModal").html("Nuevo Centinela");
    $("#idvisita").val("");
    $("#frmCentinela").attr("onsubmit", "return save(this,event)");
    $("#frmCentinela").trigger("reset");
    $("#mdlCentinela").modal("show");
}
function resetForm(ths) {
    $("#frmCentinela").trigger("reset");
    $("#idvisita").val("");
    $(ths).attr("onsubmit", "return save(this,event)");
    $("#btnText").html("Guardar");
    $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
    $(".modal-title").html("Agregar Centinela");
}