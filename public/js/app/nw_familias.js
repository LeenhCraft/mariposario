let tb;
$(document).ready(function () {
  // funcion de jquery que carga antes de mostrar un modal de bootstrap
  $("#mdlFamilias").on("show.bs.modal", function () {
    // carga las opciones del select de subordenes
    loadOption("/admin/familias/ordenes", "#idorden", "or_nombre", "idorden");
  });

  tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/familias",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "num" },
      { data: "fam_nombre" },
      { data: "or_nombre" },
      { data: "fam_date" },
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
  let ajaxUrl = base_url + "admin/familias/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlFamilias").modal("hide");
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
  let ajaxUrl = base_url + "admin/familias/search";
  $(".modal-title").html("Agregar Familias");
  $("#btnText").html("Actualizar");
  $("#btnActionForm")
    .removeClass("btn-outline-primary")
    .addClass("btn-outline-info");
  $("#frmFamilias").attr("onsubmit", "return update(this,event)");
  $("#mdlFamilias").modal("show");
  //
  $.post(ajaxUrl, { idfamilia: id }, function (data) {
    if (data.status) {
      $("#idfamilia").val(data.data.idfamilia);
      $("#idorden").val(data.data.idorden);
      $("#fam_nombre").val(data.data.fam_nombre);
      $("#fam_date").val(data.data.fam_date);
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
  let ajaxUrl = base_url + "admin/familias/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlFamilias").modal("hide");
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
    title: "Eliminar Familias",
    text: "¿Realmente quiere eliminar Familias?",
    icon: "warning",
    showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/familias/delete";
      $.post(ajaxUrl, { idfamilia: idp }, function (data) {
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
  $("#titleModal").html("Nuevo Familias");
  $("#idfamilia").val("");
  $("#frmFamilias").attr("onsubmit", "return save(this,event)");
  $("#frmFamilias").trigger("reset");
  $("#mdlFamilias").modal("show");
}

function resetForm(ths) {
  $("#frmFamilias").trigger("reset");
  $("#idfamilia").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar Familias");
}

function loadOption(ruta, selectId, text, attr, param = "") {
  // console.log(param);
  // vaciar el select
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
