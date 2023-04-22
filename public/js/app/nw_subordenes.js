let tb;
$(document).ready(function () {
tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
    url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
    url: base_url + "admin/subordenes",
    method: "POST",
    dataSrc: "",
    },
    columns: [
        {data: "idsuborden"},
		{data: "idorden"},
		{data: "sub_nombre"},
		{data: "sub_descripcion"},
		{data: "sub_date"},
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
    let ajaxUrl = base_url + "admin/subordenes/save";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlSubordenes").modal("hide");
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
    let ajaxUrl = base_url + "admin/subordenes/search";
    $(".modal-title").html("Agregar Subordenes");
    $("#btnText").html("Actualizar");
    $("#btnActionForm").removeClass("btn-outline-primary").addClass("btn-outline-info");
    $("#frmSubordenes").attr("onsubmit", "return update(this,event)");
    $("#mdlSubordenes").modal("show");
    //
    $.post(ajaxUrl, { idsuborden: id }, function (data) {
      if (data.status) {
        $("#idsuborden").val(data.data.idsuborden);
$("#idorden").val(data.data.idorden);
$("#sub_nombre").val(data.data.sub_nombre);
$("#sub_descripcion").val(data.data.sub_descripcion);
$("#sub_date").val(data.data.sub_date);

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
    let ajaxUrl = base_url + "admin/subordenes/update";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlSubordenes").modal("hide");
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
      title: "Eliminar Subordenes",
      text: "¿Realmente quiere eliminar Subordenes?",
      icon: "warning",
      showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let ajaxUrl = base_url + "admin/subordenes/delete";
        $.post(ajaxUrl, { idsuborden: idp }, function (data) {
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
    $("#titleModal").html("Nuevo Subordenes");
    $("#idsuborden").val("");
    $("#frmSubordenes").attr("onsubmit", "return save(this,event)");
    $("#frmSubordenes").trigger("reset");
    $("#mdlSubordenes").modal("show");
}
function resetForm(ths) {
    $("#frmSubordenes").trigger("reset");
    $("#idsuborden").val("");
    $(ths).attr("onsubmit", "return save(this,event)");
    $("#btnText").html("Guardar");
    $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
    $(".modal-title").html("Agregar Subordenes");
}