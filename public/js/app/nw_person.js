let tb;
$(document).ready(function () {
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/person",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "nmr" },
      { data: "name" },
      { data: "email" },
      { data: "status" },
      { data: "opciones" },
    ],
    responsive: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
  });
});

function openModal() {
  $(".modal-header").removeClass("headerUpdate");
  $(".modal-header").addClass("headerRegister");
  $("#btnActionForm").removeClass("btn-info");
  $("#btnActionForm").addClass("btn-primary");
  $("#btnText").html("Guardar");
  $(".modal-form").html("Nuevo submenus");
  $(".div_id").addClass("d-none");
  $("#id").val("");
  $("#person_form").attr("onsubmit", "return save(this,event)");
  $("#person_form").trigger("reset");
  $("#addModal").modal("show");
}

function fntEdit(idp) {
  let ajaxUrl = base_url + "admin/person/search";
  $("#titleModal").html("Actualizar");
  $("#btnActionForm").removeClass("btn-primary").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#person_form").attr("onsubmit", "return update(this,event)");
  $("#addModal").modal("show");
  //
  $.post(ajaxUrl, { id: idp }, function (data) {
    // console.log(data);
    if (data.status) {
      $("#id").val(data.data.idpersona);
      $("#dni").val(data.data.per_dni);
      $("#name").val(data.data.per_nombre);
      $("#phone").val(data.data.per_celular);
      $("#email").val(data.data.per_email);
      $("#address").val(data.data.per_direcc);
      $("#status").val(data.data.per_estado);
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
      let ajaxUrl = base_url + "admin/person/delete";
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

function save(ths, e) {
  let form = $(ths).serialize();
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/person/save";
  $.post(ajaxUrl, form, function (data) {
    divLoading.css("display", "none");
    if (data.status) {
      $("#addModal").modal("hide");
      Swal.fire("Menu", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
  });
  return false;
}

function update(ths, e) {
  let form = $(ths).serialize();
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/person/update";

  $.post(ajaxUrl, form, function (data) {
    divLoading.css("display", "none");
    if (data.status) {
      $("#modalmenus").modal("hide");
      Swal.fire("Menu", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
  });
  return false;
}
