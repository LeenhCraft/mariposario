let tb;
$(document).ready(function () {
tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
    url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
    url: base_url + "admin/especies",
    method: "POST",
    dataSrc: "",
    },
    columns: [
        {data: "idespecie"},
		{data: "idgenero"},
		{data: "es_nombre_cientifico"},
		{data: "es_nombre_comun"},
		{data: "es_habitad"},
		{data: "es_alimentacion"},
		{data: "es_plantas_hospederas"},
		{data: "es_tiempo_de_vida"},
		{data: "es_imagen_url"},
		{data: "es_date"},
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
    let ajaxUrl = base_url + "admin/especies/save";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlEspecies").modal("hide");
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
    let ajaxUrl = base_url + "admin/especies/search";
    $(".modal-title").html("Agregar Especies");
    $("#btnText").html("Actualizar");
    $("#btnActionForm").removeClass("btn-outline-primary").addClass("btn-outline-info");
    $("#frmEspecies").attr("onsubmit", "return update(this,event)");
    $("#mdlEspecies").modal("show");
    //
    $.post(ajaxUrl, { idespecie: id }, function (data) {
      if (data.status) {
        $("#idespecie").val(data.data.idespecie);
$("#idgenero").val(data.data.idgenero);
$("#es_nombre_cientifico").val(data.data.es_nombre_cientifico);
$("#es_nombre_comun").val(data.data.es_nombre_comun);
$("#es_habitad").val(data.data.es_habitad);
$("#es_alimentacion").val(data.data.es_alimentacion);
$("#es_plantas_hospederas").val(data.data.es_plantas_hospederas);
$("#es_tiempo_de_vida").val(data.data.es_tiempo_de_vida);
$("#es_imagen_url").val(data.data.es_imagen_url);
$("#es_date").val(data.data.es_date);

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
    let ajaxUrl = base_url + "admin/especies/update";
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        $("#mdlEspecies").modal("hide");
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
      title: "Eliminar Especies",
      text: "¿Realmente quiere eliminar Especies?",
      icon: "warning",
      showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let ajaxUrl = base_url + "admin/especies/delete";
        $.post(ajaxUrl, { idespecie: idp }, function (data) {
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
    $("#titleModal").html("Nuevo Especies");
    $("#idespecie").val("");
    $("#frmEspecies").attr("onsubmit", "return save(this,event)");
    $("#frmEspecies").trigger("reset");
    $("#mdlEspecies").modal("show");
}
function resetForm(ths) {
    $("#frmEspecies").trigger("reset");
    $("#idespecie").val("");
    $(ths).attr("onsubmit", "return save(this,event)");
    $("#btnText").html("Guardar");
    $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
    $(".modal-title").html("Agregar Especies");
}