let tb;
$(document).ready(function () {
  $(".js-example-basic-single").select2({
    dropdownParent: $("#modalFormUsuario"),
  });
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/user",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "nmr" },
      { data: "usu" },
      { data: "rol" },
      { data: "estado" },
      { data: "opciones" },
    ],
    responsive: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
  });

  listcb();
  personal();
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
  $("#user_form").attr("onsubmit", "return save(this,event)");
  $("#user_form").trigger("reset");
  $("#modalFormUsuario").modal("show");
}

function fntEdit(idp) {
  let ajaxUrl = base_url + "admin/user/search";
  $("#user_form").trigger("reset");
  $("#titleModal").html("Actualizar");
  $("#btnActionForm").removeClass("btn-primary").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#user_form").attr("onsubmit", "return update(this,event)");
  $("#modalFormUsuario").modal("show");
  //
  $.post(ajaxUrl, { id: idp }, function (data) {
    // console.log(data);
    if (data.status) {
      $("#id").val(data.data.idusuario);
      $("#user").val(data.data.usu_usuario);
      $("#status").val(data.data.usu_estado);
      $("#idrol").val(data.data.idrol);
      $("#idpersona").val(data.data.idpersona);
    } else {
      Toast.fire({
        icon: "error",
        title: data.message,
      });
    }
  });
}

function fntDel(idp) {
  Swal.fire({
    title: "Eliminar usuario!!",
    text: "¿Realmente quiere eliminar el usuario?",
    icon: "warning",
    showCancelButton: true,
    // confirmButtonColor: "#3085d6",
    // cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/user/delete";
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

function listcb() {
  let ajaxUrl = base_url + "admin/user/roles";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#idrol").empty();
      $.each(data.data, function (index, value) {
        $("#idrol").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
}

function personal() {
  let ajaxUrl = base_url + "admin/user/person";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#idpersona").empty();
      $.each(data.data, function (index, value) {
        $("#idpersona").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
}

function save(ths, e) {
  let form = $(ths).serialize();
  if ($("#user").val() == "" || $("#password").val() == "") {
    Swal.fire(
      "Yawar Muxus",
      "Porfavor ingrese un usuario y una contraseña para continuar",
      "warning"
    );
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/user/save";
  $.post(ajaxUrl, form, function (data) {
    divLoading.css("display", "none");
    if (data.status) {
      $("#modalFormUsuario").modal("hide");
      Swal.fire("Usuario", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
  });
  return false;
}

function update(ths, e) {
  let form = $(ths).serialize();
  if ($("#user").val() == "") {
    Swal.fire(
      "Yawar Muxus",
      "Porfavor ingrese un usuario para continuar",
      "warning"
    );
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/user/update";

  $.post(ajaxUrl, form, function (data) {
    divLoading.css("display", "none");
    if (data.status) {
      $("#modalFormUsuario").modal("hide");
      Swal.fire("Usuario", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
  });
  return false;
}
