let tb;
$(document).ready(function () {
tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
    url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
    url: base_url + "admin/generos",
    method: "POST",
    dataSrc: "",
    },
    columns: [
        {data: "idgenero"},
		{data: "idfamilia"},
		{data: "gen_nombres"},
		{data: "gen_date"},
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
    let ajaxUrl = base_url + "admin/generos/save";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlGeneros").modal("hide");
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
    let ajaxUrl = base_url + "admin/generos/search";
    $(".modal-title").html("Agregar Generos");
    $("#btnText").html("Actualizar");
    $("#btnActionForm").removeClass("btn-outline-primary").addClass("btn-outline-info");
    $("#frmGeneros").attr("onsubmit", "return update(this,event)");
    $("#mdlGeneros").modal("show");
    //
    $.post(ajaxUrl, { idgenero: id }, function (data) {
      if (data.status) {
        $("#idgenero").val(data.data.idgenero);
$("#idfamilia").val(data.data.idfamilia);
$("#gen_nombres").val(data.data.gen_nombres);
$("#gen_date").val(data.data.gen_date);

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
    let ajaxUrl = base_url + "admin/generos/update";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlGeneros").modal("hide");
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
      title: "Eliminar Generos",
      text: "¿Realmente quiere eliminar Generos?",
      icon: "warning",
      showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let ajaxUrl = base_url + "admin/generos/delete";
        $.post(ajaxUrl, { idgenero: idp }, function (data) {
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
    $("#titleModal").html("Nuevo Generos");
    $("#idgenero").val("");
    $("#frmGeneros").attr("onsubmit", "return save(this,event)");
    $("#frmGeneros").trigger("reset");
    $("#mdlGeneros").modal("show");
}
function resetForm(ths) {
    $("#frmGeneros").trigger("reset");
    $("#idgenero").val("");
    $(ths).attr("onsubmit", "return save(this,event)");
    $("#btnText").html("Guardar");
    $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
    $(".modal-title").html("Agregar Generos");
}