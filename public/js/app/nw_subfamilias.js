let tb;
$(document).ready(function () {
  $("#mdlSubfamilias").on("show.bs.modal", function () {
    loadOption("/admin/subfamilias/familias", "#idfamilia", "fam_nombre", "idfamilia");
  });
  tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/subfamilias",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "num" },
      { data: "sub_nombre" },
      { data: "fam_nombre" },
      { data: "sub_date" },
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
  let ajaxUrl = base_url + "admin/subfamilias/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlSubfamilias").modal("hide");
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
  let ajaxUrl = base_url + "admin/subfamilias/search";
  $(".modal-title").html("Editar Subfamilia");
  $("#btnText").html("Actualizar");
  $("#btnActionForm")
    .removeClass("btn-outline-primary")
    .addClass("btn-outline-info");
  $("#frmSubfamilias").attr("onsubmit", "return update(this,event)");
  $("#mdlSubfamilias").modal("show");
  //
  $.post(ajaxUrl, { idsubfamilia: id }, function (data) {
    if (data.status) {
      $("#idsubfamilia").val(data.data.idsubfamilia);
      $("#idfamilia").val(data.data.idfamilia);
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
  let ajaxUrl = base_url + "admin/subfamilias/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlSubfamilias").modal("hide");
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
      let ajaxUrl = base_url + "admin/subfamilias/delete";
      $.post(ajaxUrl, { idsubfamilia: idp }, function (data) {
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
  $("#idsubfamilia").val("");
  $("#frmSubfamilias").attr("onsubmit", "return save(this,event)");
  $("#frmSubfamilias").trigger("reset");
  $("#mdlSubfamilias").modal("show");
}
function resetForm(ths) {
  $("#frmSubfamilias").trigger("reset");
  $("#idsubfamilia").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar Subfamilias");
}
function loadOption(ruta, selectId, text, attr, param = "") {
  $(selectId).empty();
  $.ajax({
    type: "POST",
    url: ruta,
    data: param,
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, value) {
        $(selectId).append(
          $("<option>").text(value[text]).attr("value", value[attr])
        );
      });
    },
  });
}