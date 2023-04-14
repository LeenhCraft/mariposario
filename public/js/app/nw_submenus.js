let tb;
$(document).ready(function () {
  tb = $("#sis_submenus").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/submenus",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "nmr", class: "text-left" },
      { data: "submenu", class: "font-weight-bold" },
      { data: "menu" },
      { data: "url", class: "text-left" },
      { data: "orden", class: "text-center" },
      { data: "ver", class: "text-center" },
      { data: "options", class: "text-center" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[1, "desc"]],
  });
});

function fntView(id) {
  let ajaxUrl = base_url + "admin/submenus/search";
  $.post(ajaxUrl, { id: id }, function (data) {
    $("#idsubmenu").html(data.data.idsubmenu);
    $("#idmenuu").html(data.data.idmenu);
    $("#sub_nombre").html(data.data.sub_nombre);
    $("#sub_url").html(data.data.sub_url);
    $("#sub_controlador").html(data.data.sub_controlador);
    $("#sub_icono").html(data.data.sub_icono);
    $("#sub_orden").html(data.data.sub_orden);
    $("#sub_visible").html(data.data.sub_visible);
    $("#sub_fecha").html(data.data.sub_fecha);
    $("#mdView").modal("show");
  });
}

function fntEdit(id) {
  lstMenus();
  let ajaxUrl = base_url + "admin/submenus/search";
  $(".modal-form").html("Actualizar submenus");
  $(".modal-header").removeClass("headerRegister");
  $(".modal-header").addClass("headerUpdate");
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-info");
  $(".div_id").removeClass("d-none");
  $("#btnText").html("Actualizar");
  $("#submenus_form").attr("onsubmit", "return update(this,event)");
  // $("#submenus_form").attr("id", "update_form");
  $("#modalsubmenus").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    // console.log(data);
    if (data.status) {
      $("#id").val(data.data.idsubmenu);
      $("#idmenu").val(data.data.idmenu);
      $("#idsubmenu").val(data.data.idsubmenu);
      $("#name").val(data.data.sub_nombre);
      $("#url").val(data.data.sub_url);
      $("#controller").val(data.data.sub_controlador);
      $("#method").val(data.data.sub_metodo);
      $("#icon").val(data.data.sub_icono);
      $("#order").val(data.data.sub_orden);
      $("#visible").val(data.data.sub_visible);
      $("#fecha").val(data.data.sub_fecha);
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
      let ajaxUrl = base_url + "admin/submenus/delete";
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

function openModal() {
  lstMenus();
  $(".modal-header").removeClass("headerUpdate");
  $(".modal-header").addClass("headerRegister");
  $("#btnActionForm").removeClass("btn-info");
  $("#btnActionForm").addClass("btn-primary");
  $("#btnText").html("Guardar");
  $(".modal-form").html("Nuevo submenus");
  $(".div_id").addClass("d-none");
  $("#id").val("");
  // $("#update_from").attr("id", "submenus_form");
  $("#submenus_form").attr("onsubmit", "return save(this,event)");
  $("#submenus_form").trigger("reset");
  $("#modalsubmenus").modal("show");
}

function lstMenus() {
  let ajaxUrl = base_url + "admin/submenus/menus";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#idmenu").empty();
      $.each(data.data, function (index, value) {
        $("#idmenu").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
}

function update(ths, e) {
  let sub_nombre = $("#name").val();
  let sub_url = $("#url").val();
  let sub_controlador = $("#controller").val();
  let sub_method = $("#method").val();
  let form = $(ths).serialize();
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para el submenu.", "warning");
    return false;
  }
  if (sub_url == "") {
    Swal.fire("Atención", "Es necesario una url para el submenu.", "warning");
    return false;
  }
  if (sub_controlador == "") {
    Swal.fire(
      "Atención",
      "Es necesario el controlador para el submenu.",
      "warning"
    );
    return false;
  }
  if (sub_method == "") {
    Swal.fire("Atención", "Es necesario el metodo para el submenu.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/submenus/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#modalsubmenus").modal("hide");
      Swal.fire("submenus", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}

function save(ths, e) {
  let sub_nombre = $("#name").val();
  let sub_url = $("#url").val();
  let sub_controlador = $("#controller").val();
  let sub_method = $("#method").val();
  let form = $(ths).serialize();
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para el submenu.", "warning");
    return false;
  }
  if (sub_url == "") {
    Swal.fire("Atención", "Es necesario una url para el submenu.", "warning");
    return false;
  }
  if (sub_controlador == "") {
    Swal.fire(
      "Atención",
      "Es necesario el controlador para el submenu.",
      "warning"
    );
    return false;
  }
  if (sub_method == "") {
    Swal.fire("Atención", "Es necesario el metodo para el submenu.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/submenus/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#modalsubmenus").modal("hide");
      Swal.fire("submenus", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}
